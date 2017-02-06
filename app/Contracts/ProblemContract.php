<?php
/**
 * Created by PhpStorm.
 * User: skyfire
 * Date: 17-2-4
 * Time: 下午2:48
 */
namespace App\Contracts;
interface ProblemContract
{
    public function setPlatform($platform);

    public function obtainContent($id);

    public function submit();
}