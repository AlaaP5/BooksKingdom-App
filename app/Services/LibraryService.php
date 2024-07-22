<?php

namespace App\Services;

use App\Events\EvaluationEvent;
use App\Events\SendNotificationEvent;
use App\Models\Book;
use App\Models\LibBook;
use App\Models\Library;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;


class LibraryService
{
    public function add($request)
    {
        DB::beginTransaction();
        try {
            $id = Auth::id();
            $user = Auth::user();
            $book = Book::find($request->book_id);
            $wallet = Wallet::where('user_id', $id)->first();
            if ($book->price <= $wallet->content) {
                $find = Library::where('user_id', $id)->first();
                if (empty($find)) {
                    $find = Library::create([
                        'number_books' => 1,
                        'read_books' => 0,
                        'read_pages' => 0,
                        'all_pages' => $book->pages,
                        'user_id' => $id
                    ]);
                } else {
                    $bookRequest = LibBook::where('library_id', $find->id)->where('book_id', $request->book_id)->first();
                    if (!empty($bookRequest)) {
                        return response(['message' => 'The book was previously added'], 409);
                    }
                    $find->number_books += 1;
                    $find->all_pages += $book->pages;
                    $find->save();
                }
                LibBook::create([
                    'read_pages' => 0,
                    'sign' => 0,
                    'condition_id' => 1,
                    'library_id' => $find->id,
                    'book_id' => $request->book_id
                ]);
                $wallet->content -= $book->price;
                $wallet->save();
                DB::commit();
                $fcmToken = $user->fcm_token;
                if (!empty($fcmToken)) {
                    Event::dispatch(new SendNotificationEvent('library', 'jhh', $user));
                }
                return response()->json(['message' => 'The book is added to your library Successfully'], 200);
            } else {
                return response()->json(['message' => 'your points not enough'], 403);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function booksOfCondition($id)
    {
        try {
            $id1 = Auth::id();
            $lib = Library::where('user_id', $id1)->first();
            $library = LibBook::where('condition_id', $id)->where('library_id', $lib->id)->get();
            if (count($library)) {
                foreach ($library as $libra) {
                    $books = Book::find($libra->book_id);
                    if ($books) {
                        $books->image = asset('files/' . $books->image);
                        $books->content = asset('files/' . $books->content);
                        $output[] = $books;
                    }
                }
                return response()->json(['data' => $output], 200);
            }
            return response()->json(['message' => 'not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function addSign($request)
    {
        DB::beginTransaction();
        try {
            $id = Auth::id();
            $lib = Library::where('user_id', $id)->first();
            if (empty($lib)) {
                return response()->json(['message' => 'you have not library'], 404);
            }
            $library = LibBook::where('book_id', $request->book_id)->where('library_id', $lib->id)->first();
            if (empty($library)) {
                return response()->json(['message' => 'you can not add sign'], 403);
            } else {
                if ($library->condition_id != 3) {
                    $book = Book::find($request->book_id);
                    if ($book->pages == $request->page) {
                        $lib->read_books += 1;
                        $lib->read_pages += ($request->page - $library->sign);
                        $lib->save();
                        $library->condition_id = 3;
                        $library->read_pages = $request->page;
                        $library->sign = $request->page;
                        $library->save();
                    } else {
                        if ($book->pages > $request->page) {
                            $lib->read_pages += ($request->page - $library->sign);
                            $lib->save();
                            $library->sign = $request->page;
                            $library->read_pages = $request->page;
                            $library->condition_id = 2;
                            $library->save();
                        } else {
                            return response()->json(['message' => 'The page is not found'], 404);
                        }
                    }
                    Event::dispatch(new EvaluationEvent($lib, $book, $library->read_pages));
                    DB::commit();
                    return response()->json(['message' => 'The sign has been successfully added'], 200);
                } else {
                    return response()->json(['message' => 'you can not add sign, the book readable'], 200);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
