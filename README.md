postmanを使って、userテーブルの登録している
個人プロフィールの下記カラムの上書きが出来ず、レスポンスでは
エラーが出ず、原因がわかっていません。

コントローラファイル
\\wsl.localhost\Ubuntu\home\daisuke\gs_Graduation_work\laravel-gw01\app\Http\Controllers\Api\UserController.php
下記関数で上書きを指示
    public function updateUser(Request $request)

ルーティングのファイル
\\wsl.localhost\Ubuntu\home\daisuke\gs_Graduation_work\laravel-gw01\routes\api.php

下記がルーティング
    Route::put('user', [UserController::class, 'updateUser']);



