<?php

namespace App\Services;

use App\Repositories\LinkRepositoryInterface;
use Exception;

class LinkService
{
    private $linkRepositoryInterface;

    public function __construct(LinkRepositoryInterface $linkRepositoryInterface)
    {
        $this->linkRepositoryInterface = $linkRepositoryInterface;
    }

    public function store($data)
    {
        try {
            $alreadyExists = $this->linkRepositoryInterface->getLink($data["link"]);

            if (!empty($alreadyExists)) {
                throw new Exception('O QR Code deste link já foi criado.', 400);
            }

            $this->linkRepositoryInterface->store($data);

            return response()->json(
                [
                    "type" => "success",
                    "message" => 'Link criado com sucesso!',
                ],
            );

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }

    }

    public function getList()
    {
        try {
            $data = $this->linkRepositoryInterface->getList();
            return $data;
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
            return $this->linkRepositoryInterface->get($id);
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "type" => "error",
                    "message" => $exception->getMessage(),
                ],
            );
        }
    }

    public function update(array $data, $id)
    {
        try {
            return $this->linkRepositoryInterface->update($data, $id);
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
            $this->linkRepositoryInterface->destroy($id);
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
            );
        }
    }
}
