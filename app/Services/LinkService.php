<?php

namespace App\Services;

use App\Models\Link;
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
                throw new Exception('Este link já foi criado.', 400);
            }

            if (empty($data["identifier"])) {
                $uniqueIdentifier = $this->generateUniqueIdentifier();
                $data["identifier"] = $uniqueIdentifier;
            }

            $shortenedUrl = url("/visit/{$data["identifier"]}");

            $this->linkRepositoryInterface->store([
                "link" => $data["link"],
                "identifier" => $data["identifier"],
                "encurted_link" => $shortenedUrl,
            ]);

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
                $exception->getCode()
            );
        }

    }

    private function generateUniqueIdentifier($length = 8)
    {
        try {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            $randomString = str_replace(' ', '', $randomString);

            $existingIdentifiers = Link::pluck('identifier')->toArray();
            while (in_array($randomString, $existingIdentifiers)) {
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, strlen($characters) - 1)];
                }
                $randomString = str_replace(' ', '', $randomString);
            }

            return $randomString;

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
            $data = $this->linkRepositoryInterface->getList();
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

    public function get($identifier)
    {
        try {
            return $this->linkRepositoryInterface->get($identifier);

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

    public function getById($identifier)
    {
        try {
            return $this->linkRepositoryInterface->getById($identifier);

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
            return $this->linkRepositoryInterface->update($data, $id);

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
                $exception->getCode()
            );
        }
    }
}
