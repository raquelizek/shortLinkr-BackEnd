<?php

namespace App\Services;

use App\Models\Access;
use App\Models\Link;
use App\Repositories\AccessRepositoryInterface;

class AccessService
{
    private $accessRepositoryInterface;

    public function __construct(AccessRepositoryInterface $accessRepositoryInterface)
    {
        $this->accessRepositoryInterface = $accessRepositoryInterface;
    }

    public function store($data)
    {
        try {

            $access = $this->accessRepositoryInterface->store([
                "ip" => $data["ip"],
                "user_agent" => $data["user_agent"],
                "user_clicked" => false,
            ]);

            return response()->json(
                [
                    "type" => "success",
                    "data" => $access,
                    "message" => 'Dados registrados com sucesso!',
                ],
                200
            );

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
                $exception->getCode()
            );
        }
    }

    public function getList()
    {
        try {
            $data = $this->accessRepositoryInterface->getList();
            return $data;

        } catch (\Exception $exception) {

            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
                $exception->getCode()
            );
        }
    }

    public function get($id)
    {
        try {
            return $this->accessRepositoryInterface->get($id);

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
                $exception->getCode()
            );
        }
    }

    public function getAccess()
    {
        try {

            $countLinks = Link::whereNotNull('link')->count();

            $countAccess = Access::whereNotNull('id')->count();

            $countClicks = Access::where('user_clicked', true)->count();

            return response()->json(
                [
                    "type" => "success",
                    "data" => [
                        "countLinks" => $countLinks,
                        "countAccess" => $countAccess,
                        "countClicks" => $countClicks,
                    ],
                ],
                200
            );

        } catch (\Exception $exception) {

            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
                $exception->getCode()
            );
        }
    }

    public function update(array $data, $id)
    {
        try {
            return $this->accessRepositoryInterface->update($data, $id);

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
                $exception->getCode()
            );
        }
    }

    public function destroy($id)
    {
        try {
            $this->accessRepositoryInterface->destroy($id);
            return response()->json(
                [
                    "type" => "success",
                    "message" => 'Excluído com sucesso!',
                ],
            );

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
                $exception->getCode()
            );
        }
    }
}
