<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic;

class File extends Model
{

    public $timestamps = true;
    protected $fillable = [
        'name',
        'path',
        'image_link',
        'thumbnailpath',
        'resizedpath',
        'sliderpath',
        'type',
        'extension',
        'size',
        'module_name',
        'ord'
    ];
    protected $dates = ['created_at', 'updated_at'];

    public static $default_accept_extensions = [
        'jpg',
        'jpeg',
        'png',
        'gif'
    ];

    public static $upload_dir = 'uploads';
    public static $defaultImageLimit = [900, 1200];
    public static $resizeDimensions = [
        'avatar' => [
            'width' => 100,
            'height' => 100
        ],
        'thumbnail' => [
            'width' => 260,
            'height' => 170
        ],
        'resized' => [
            'width' => 850,
            'height' => 360
        ],
        'slider' => [
            'width' => 1135,
            'height' => 434
        ]
    ];
    public static $resizeModule = [
        'avatar',
        'thumbnail',
        'resized',
        'slider'
    ];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function morph()
    {
        return $this->belongsTo(Morph::class, 'fileable_type', 'name');
    }

    public static function boot()
    {

    }

    public static function getType($extension)
    {
        $types = [
            'image' => ['jpg', 'png', 'jpeg', 'gif'],
            'document' => ['doc', 'docx', 'xls', 'xlsx', 'pdf', 'odt', 'txt'],
            'favicon' => ['ico']
        ];

        foreach ($types as $type => $extensions) {
            if (in_array(strtolower($extension), $extensions)) {
                return $type;
            }
        }

        return 'undefined';
    }

    public static function fullDir($file = '')
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/' . $file;
    }

    public static function path($filename)
    {
        if (!$filename) {
            return self::$upload_dir . "/";
        } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $filename)) {
            return $filename;
        } else {
            return self::$upload_dir . "/" . $filename;
        }
    }

    public static function dropFile($path, $id = 0)
    {
        $used = self::where('path', 'like', "%{$path}")->where('id', '<>', $id)->count();

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $path) && $used == 0) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $path);
        }
    }

    public static function drop($id)
    {
        $file = self::findOrFail($id);
        if ($file) {
            self::dropFile($file->path, $id);
        }
        return self::destroy($id);
    }

    public static function dropMultiple($fileable_type, $fileable_id)
    {
        foreach (self::where([
            'fileable_type' => $fileable_type,
            'fileable_id' => $fileable_id
        ])->get() as $file) {
            self::dropFile($file->path, $file->id);
            self::destroy($file->id);
        }
    }

    public static function dropByMorphed($morphed)
    {
        self::dropMultiple(get_class($morphed), $morphed->id);
    }

    public static function resizeImage($image, $module_name, $savePath = false)
    {
        $resizeImage = ImageManagerStatic::make(file_get_contents($image));

        if (in_array($module_name, self::$resizeModule)) {
            if (self::$resizeDimensions[$module_name]['width'] == self::$resizeDimensions[$module_name]['height']) {
                $minimumDimension = min($resizeImage->width(), $resizeImage->height());
                $resizeImage->fit($minimumDimension);
            }

            $resizeImage->resize(
                self::$resizeDimensions[$module_name]['width'],
                self::$resizeDimensions[$module_name]['height']
            );

            $image = $savePath ? $savePath : $image;
            $directory = dirname($image);

            if (!file_exists($directory)) {
                mkdir($directory, 0777);
            }

            $resizeImage->save($image);
        }
    }
}
