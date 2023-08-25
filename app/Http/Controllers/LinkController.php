<?php

namespace App\Http\Controllers;

use App\Services\LinkService;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private $service;

    public function __construct(LinkService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        try {
            return $this->service->store([
                'link' => $request->input('link'),
                'identifier' => $request->input('identifier'),
                'encurted_link' => $request->input('encurted_link'),
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

    public function get(Request $request)
    {
        try {
            return $this->service->get($request->identifier);
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }
    }

    public function getById(Request $request)
    {
        try {
            return $this->service->getById($request->id);
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }
    }

    public function update(Request $request, $id)
    {
        try {
            return $this->service->update([
                'link' => $request->input('link'),
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
