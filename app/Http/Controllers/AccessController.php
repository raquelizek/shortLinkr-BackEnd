<?php

namespace App\Http\Controllers;

use App\Services\AccessService;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    private $service;

    public function __construct(AccessService $service)
    {
        $this->service = $service;

    }

    public function store(Request $request)
    {
        try {

            return $this->service->store([
                'ip' => $request->input('ip'),
                'user_agent' => $request->input('user_agent'),
            ]);
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }

    }

    public function all()
    {
        try {

            return $this->service->getList();

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }
    }

    public function get($id)
    {
        try {
            return $this->service->get($id);
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }
    }

    public function getAccess(Request $request)
    {
        try {
            return $this->service->getAccess($request->identifier);
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }
    }


    public function update($id)
    {
        try {
            return $this->service->update([
                'user_clicked' => true,
            ], $id);
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }
    }

    public function destroy($id)
    {
        try {
            return $this->service->destroy($id);

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }
    }
}
