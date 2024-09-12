<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Response;

class FriendRequestController extends Controller
{
    public function sendRequest(User $receiver)
    {
        // Проверка, не отправлял ли текущий пользователь уже запрос этому пользователю
        $existingRequest = FriendRequest::where('sender_id', auth()->id())
                                        ->where('receiver_id', $receiver->id)
                                        ->first();
        if ($existingRequest) {
            return Response::json([
                'message' => 'запрос уже был отправлен'
            ]);
        }

        // Создание нового запроса на дружбу
        FriendRequest::create([
            'sender_id' => auth()->id(), // ID текущего пользователя
            'receiver_id' => $receiver->id, // ID пользователя, которому отправляется запрос
        ]);

        return Response::json([
           'message' => "все ок"
        ]);
    }

    // Метод для принятия запроса на дружбу
    public function acceptRequest(FriendRequest $request)
    {
        // Обновление статуса запроса на "принят"

        if (!$request) {
            return Response::json([
                'message' => 'запрос не найден'
            ]);
        }
        $request->update(['status' => 'accepted']);

        return Response::json ([
            'message' => 'запрос принят'
        ]);
    }

    // Метод для отклонения запроса на дружбу
    public function rejectRequest(FriendRequest $request)
    {

        if (!$request) {
            return Response::json([
                'message' => 'запрос не найден'
            ]);
        }

        $request->update(['status' => 'rejected']); // Обновление статуса запроса на "отклонен"
        return Response::json([
            'message' => 'запрос отклонен'
        ]);
    }

    public function sendBlacklist (FriendRequest $request){
        if(!$request){
            return Response::json([
                'message' => 'пользователь уже в черном списке'
            ]);
        }
        $request->update(['status' => 'blacklist']); // Обновление статуса запроса на "отклонен"
        return Response::json([
            'message' => 'пользователь добавлен в черный список'
        ]);
    }

    public function removeBlacklist (FriendRequest $request){
        $request->update(['status' => 'pending']);
        return Response::json([
            'message' => 'пользователь убран из черного списка'
        ]);
    }

    public function getAcceptedFriends(Request $request){
        $skipElements = ($request->page - 1) * $request->count;
        $friends = FriendRequest::where('status', 'accepted')
                                ->skip($skipElements)
                                ->take($request->count)
                                ->get();

        return Response::json(
            $friends
        );
    }

    public function getBlacklistedUsers(Request $request){
        $skipElements = ($request->page - 1) * $request->count;
        $friends = FriendRequest::where('status', 'blacklist')
                                ->skip($skipElements)
                                ->take($request->count)
                                ->get();

        return Response::json(
            $friends
        );
    }
}