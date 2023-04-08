<?php

namespace App;

//use App\ContentableModel;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\Input;

class Page extends ContentableModel
{
    use Translatable;
    use FormableTrait;
    public $translatedAttributes = ['title', 'body', 'favicon_title'];
    protected $fillable = ['name', 'title', 'body', 'favicon_title'];
    public $new = null;



    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

    public function news()
    {
        return $this->hasOne(PageHasNews::class);
    }

    public function footers()
    {
        return $this->belongsToMany(Footer::class, 'page_has_footers')->where('visible',true);
    }

    public function headers()
    {
        return $this->belongsToMany(Header::class, 'page_has_headers')->where('visible',true);
    }

    public function parent()
    {
        return $this->belongsTo(Page::class);
    }

    public function getBreadCrumbChain()
    {
        $res = array();
        $res[] = array('name' => $this->favicon_title, 'href' => null);
        $parent = $this->parent;
        $isMain = true;
        while (isset($parent)) {
            $res[] = array('name' => $parent->favicon_title, 'href' => url('/' . $parent->getName()));
            $parent = $parent->parent;
            $isMain = false;
        };
        if ($isMain) return null;
        return array_reverse($res);
    }

}

class PageTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'body', 'favicon_title'];
}