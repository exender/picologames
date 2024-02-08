<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\TokenController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\ModeController;
use App\Http\Controllers\Admin\PicoloController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GamePlayerController;
use App\Events\Test;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authentificated', function () {
    return true;
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authentificated', function () {
    return true;
});


/**
 * @OA\Post(
 *     path="/register",
 *     tags={"Authentication"},
 *     summary="Register a new user",
 *     operationId="register",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::post('register', [RegisterController::class, 'index']);

 /**
 * @OA\Post(
 *     path="/login",
 *     tags={"Authentication"},
 *     summary="Login an existing user",
 *     operationId="login",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/TokenResponse")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::post('login', [LoginController::class, 'index']);

 /**
 * @OA\Post(
 *     path="/logout",
 *     tags={"Authentication"},
 *     summary="Logout an existing user",
 *     operationId="Logout",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/LogoutRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/TokenResponse")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::post('logout', [LoginController::class, 'logout']);

/**
 * @OA\Get(
 *     path="/token/{id}",
 *     tags={"Token"},
 *     summary="Get token by ID",
 *     operationId="getTokenById",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the token",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Token")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Token not found",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::get('token/{id}', [TokenController::class, 'index']);


/**
 * @OA\Get(
 *     path="/user/{id}",
 *     tags={"User"},
 *     summary="Get user by ID",
 *     operationId="getUserById",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::get('user/{id}', [UserController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    /**
     * @OA\Get(
     *     path="user/edit/{id}",
     *     tags={"User"},
     *     summary="Edit user by ID",
     *     operationId="editUserById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::get('edit/{id}', [UserController::class, 'edit']);

    /**
     * @OA\Put(
     *     path="/user/update/{id}",
     *     tags={"User"},
     *     summary="Update user by ID",
     *     operationId="updateUserById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::put('update/{id}', [UserController::class, 'update']);
});

Route::group(['prefix' => 'mode'], function () {
    /**
     * @OA\Get(
     *     path="/mode/all",
     *     tags={"Mode"},
     *     summary="Get all modes",
     *     operationId="getAllModes",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Mode")
     *         )
     *     )
     * )
     */
    Route::get('all', [ModeController::class, 'index']);
    
    /**
     * @OA\Post(
     *     path="/mode/add",
     *     tags={"Mode"},
     *     summary="Add a new mode",
     *     operationId="addMode",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ModeRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mode added successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Mode")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::post('add', [ModeController::class, 'store']);
    /**
     * @OA\Get(
     *     path="/mode/edit/{id}",
     *     tags={"Mode"},
     *     summary="Edit mode by ID",
     *     operationId="editModeById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the mode",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Mode")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mode not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::get('edit/{id}', [ModeController::class, 'edit']);
    /**
     * @OA\Get(
     *     path="/mode/show/{id}",
     *     tags={"Mode"},
     *     summary="Show mode by ID",
     *     operationId="showModeById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the mode",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Mode")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mode not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::get('show/{id}', [ModeController::class, 'show']);
    /**
     * @OA\Put(
     *     path="/mode/update/{id}",
     *     tags={"Mode"},
     *     summary="Update mode by ID",
     *     operationId="updateModeById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the mode",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ModeRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mode updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Mode")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mode not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::put('update/{id}', [ModeController::class, 'update']);
    /**
     * @OA\Delete(
     *     path="/mode/delete/{id}",
     *     tags={"Mode"},
     *     summary="Delete mode by ID",
     *     operationId="deleteModeById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the mode",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mode deleted successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mode not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::delete('delete/{id}', [ModeController::class, 'destroy']);
});

Route::group(['prefix' => 'picolo'], function () {
    /**
     * @OA\Get(
     *     path="/picolo/all",
     *     tags={"Picolo"},
     *     summary="Get all picolos",
     *     operationId="getAllPicolos",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Picolo")
     *         )
     *     )
     * )
     */
    Route::get('all', [PicoloController::class, 'index']);
    /**
     * @OA\Get(
     *     path="/picolo/all-suggested",
     *     tags={"Picolo"},
     *     summary="Get all suggested picolos",
     *     operationId="getAllSuggestedPicolos",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Picolo")
     *         )
     *     )
     * )
     */
    Route::get('all-suggested', [PicoloController::class, 'suggested']);
    /**
     * @OA\Post(
     *     path="/picolo/add",
     *     tags={"Picolo"},
     *     summary="Add a new picolo",
     *     operationId="addPicolo",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PicoloRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Picolo added successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Picolo")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::post('add', [PicoloController::class, 'store']);
    /**
     * @OA\Get(
     *     path="/picolo/edit/{picolo}",
     *     tags={"Picolo"},
     *     summary="Edit picolo by ID",
     *     operationId="editPicoloById",
     *     @OA\Parameter(
     *         name="picolo",
     *         in="path",
     *         required=true,
     *         description="ID of the picolo",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Picolo")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Picolo not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::get('edit/{picolo}', [PicoloController::class, 'edit']);
    /**
     * @OA\Get(
     *     path="/picolo/show/{id}",
     *     tags={"Picolo"},
     *     summary="Show picolo by ID",
     *     operationId="showPicoloById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the picolo",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Picolo")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Picolo not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::get('show/{id}', [PicoloController::class, 'show']);

    /**
     * @OA\Put(
     *     path="/picolo/update/{id}",
     *     tags={"Picolo"},
     *     summary="Update picolo by ID",
     *     operationId="updatePicoloById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the picolo",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PicoloRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Picolo updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Picolo")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Picolo not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::put('update/{id}', [PicoloController::class, 'update']);

    /**
     * @OA\Put(
     *     path="/picolo/validate/{id}",
     *     tags={"Picolo"},
     *     summary="Validate picolo by ID",
     *     operationId="validatePicoloById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the picolo",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Picolo validated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Picolo not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::put('validate/{id}', [PicoloController::class, 'validatePiloco']);

    /**
     * @OA\Delete(
     *     path="/picolo/delete/{id}",
     *     tags={"Picolo"},
     *     summary="Delete picolo by ID",
     *     operationId="deletePicoloById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the picolo",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Picolo deleted successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Picolo not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    Route::delete('delete/{id}', [PicoloController::class, 'destroy']);
});



/**
 * @OA\Get(
 *     path="/play-game-picolo",
 *     tags={"Game"},
 *     summary="Play a picolo game",
 *     operationId="playPicoloGame",
 *     @OA\Response(
 *         response=200,
 *         description="Success"
 *     )
 * )
 */
Route::get('play-game-picolo', function(){
    broadcast(new Test());
});


/**
 * @OA\Post(
 *     path="/create-game",
 *     tags={"Game"},
 *     summary="Create a new game",
 *     operationId="createGame",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Game data",
 *         @OA\JsonContent(ref="#/components/schemas/GameRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Game created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Game")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::post('create-game', [GameController::class, 'store']);

/**
 * @OA\Post(
 *     path="/play-game-picolo",
 *     tags={"Game"},
 *     summary="Play a Picolo game",
 *     operationId="playPicoloGame",
 *     @OA\Response(
 *         response=200,
 *         description="Success"
 *     )
 * )
 */
Route::post('play-game-picolo', function(){
    broadcast(new Test());
});


/**
 * @OA\Put(
 *     path="/add-player-game",
 *     tags={"Game"},
 *     summary="Add a player to the game",
 *     operationId="addPlayerToGame",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Player data",
 *         @OA\JsonContent(ref="#/components/schemas/PlayerRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Player added successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Player")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::put('add-player-game', [GameController::class, 'update']);


// Route::apiResource('game-players', GamePlayerController::class);

/**
 * @OA\Get(
 *     path="/game-players/{id}",
 *     tags={"Game"},
 *     summary="Get players of a specific game",
 *     operationId="getPlayersOfGame",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the game",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Player")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Game not found",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::get('game-players/{id}', [GamePlayerController::class, 'index']);

/**
 * @OA\Post(
 *     path="/game-players",
 *     tags={"Game"},
 *     summary="Create a new player for a game",
 *     operationId="createPlayerForGame",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Player data",
 *         @OA\JsonContent(ref="#/components/schemas/PlayerRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Player created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Player")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::post('game-players', [GamePlayerController::class, 'store']);


/**
 * @OA\Get(
 *     path="/game-players/{id}",
 *     tags={"Game"},
 *     summary="Get players of a specific game",
 *     operationId="getPlayersOfGame",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the game",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Player")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Game not found",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::post('redirect', [GameController::class, 'redirect']);

/**
 * @OA\Post(
 *     path="/game-players",
 *     tags={"Game"},
 *     summary="Add a new player to the game",
 *     operationId="addPlayerToGame",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Player data",
 *         @OA\JsonContent(ref="#/components/schemas/PlayerRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Player added successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Player")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::post('next', [GameController::class, 'next']);

/**
 * @OA\Post(
 *     path="/msg",
 *     tags={"Game"},
 *     summary="Send a message",
 *     operationId="sendMessage",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Message data",
 *         @OA\JsonContent(ref="#/components/schemas/MessageRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Message sent successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Message")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
Route::post('msg', [GameController::class, 'msg']);
