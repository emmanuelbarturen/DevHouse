<?php namespace DevHouse;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 24/06/2017
 * Time: 10:41 AM
 */

trait FileManagerTrait
{
    /**
     * Make file and return path
     * @param $fileName
     * @param $template_path
     * @param $target_path
     * @param array $data
     * @return string
     */
    public function makeFile($fileName, $template_path, $target_path, array $data)
    {
        try {
            $keys = array_keys($data);
            $values = array_values($data);
            $template = file_get_contents($template_path) or dd('No se pudo abrir el template del repositorio',
                $template_path);

            $contents = str_replace($keys, $values, $template);

            if (!is_dir($target_path)) {
                mkdir($target_path, 077, true);
            }

            file_put_contents($target_path . '/' . $fileName, $contents);

            return $target_path . '/' . $fileName;
        } catch (Exception $e) {
            Log::error($e);
        }
        return false;
    }
}