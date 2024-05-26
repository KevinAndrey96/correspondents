<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *             title="User Login",
 *             version="1.0",
 *             description="Here is endpoint to login user"
 * )
 *
 * @OA\Server(url="http://127.0.0.1:8000")
 */
class LoginUsersController extends Controller
{
    /**
     * User Login
     * @OA\Post (
     *     path="/api/v1/user/login",
     *     tags={"Login"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string")
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Success Login",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Success Login"
     *              ),
     *              @OA\Property(
     *                   property="access_token",
     *                   type="string",
     *                   example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNWM5NzZhMWJkYjNhMjdiNjBjZDEyNWU2OTQ5ZWY5YjQ3MWE1ZTA4MzQyODJlNDAwNmU4MzJkODY5ODYyMTg0M2FhMzkzMDMwYjI1YzM1MGYiLCJpYXQiOjE3MTY2OTMyMzQuNzA2NjksIm5iZiI6MTcxNjY5MzIzNC43MDY2OTUsImV4cCI6MTc0ODIyOTIzNC40MjkzODcsInN1YiI6IjI3Iiwic2NvcGVzIjpbXX0.5XcEdol8IOx7Z8ot3jnK9BsmIRlTo5mDUSTcl3dOOlTY40kWmi26OULLjwXLDBWVW0SmwXxYM8c6zhpXo0I-ahEAmUMrIXtzYQGZIV4fsJeFjnVyBUJocTSydfp96dmYPNxgqbYHYIR-dZaBSrXKFU1yJ_R3ozz_1K4UlGv2i5eDHOSmqMS_vFTEQWUeTYuDc9gppmqTOn9IV3CXQRGi_8cTlHhdSGlb2Fx8rj2ccUh5Lenrc59A79euPEl0Gh09xJZLvaIFd0ZvwCQnmA-ZVhsv5CRk0ReC4QGBqOPpOmPc_z_yK_F5gpiUMGEWzZy33tn1JVe92sfdAhpGyYulr4Kpxa8cpgvOSQ45HyE0bwpoSL0008S_nEQiMTdvnNr-lcdyMRpYM__nanXiOpQFl3U3N-1R5oiOb83-bh0U5elrdqnhmEECiluFN1T2Mkd97C4IeHmA4lpHI8dZGVyYeou34JKG30Ht2qeU8V84Gtn6DX6JZWzQjgk9Ryn4PlecA-rIuQdLzeSWbQpDTuInuz0s51srnIY4s0FIoTCFNVOdK10Tkd9eRHk-UDJvaufk8FapNqMWIn16PjLbQ9hnRMdkKq9JwmIvOkq7Ory96h0JuyAQ0SLxP6GdjNhp8rtEiqbyNtLGUTNrfPmhw18HP-3rQ4mlKPdrym1U2gdjqAM"
     *              )
     *           )
     *        ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                   property="message",
     *                   type="string",
     *                   example="Invalid Credentials"
     *               ),
     *            )
     *         ),
     *     @OA\Response(
     *           response=403,
     *           description="Forbidden Access",
     *           @OA\JsonContent(
     *               @OA\Property(
     *                    property="message",
     *                    type="string",
     *                    example="Forbidden Access"
     *                ),
     *             )
     *          )
     *     )
     *
     */

    public function __invoke(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (! auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials'], 400);
        }

        if (auth()->user()->developer_mode != 1) {
            return response(['message' => 'Forbidden Access'], 403);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'message' => 'Success Login',
            'access_token' => $accessToken
        ], 200);
    }
}
