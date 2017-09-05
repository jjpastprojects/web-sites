<?php

namespace Lembarek\Admin\ViewComposers;

use Illuminate\View\View;
use Lembarek\UploadManager\Services\UploadsManager;

class TinyMceComposer
{

    protected $uploadManager;

    public function __construct(UploadsManager $uploadManager)
    {
        $this->uploadManager = $uploadManager;
    }

    /**
     * attach variable to view
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $images = $this->uploadManager->folderInfo('images')['files'];
        $view->with('images', $images);
    }


}
