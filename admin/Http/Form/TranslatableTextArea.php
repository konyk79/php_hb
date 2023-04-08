<?php

namespace Admin\Form\Element;

use AdminFormElement;
use App;
use App\Language;
use Closure;
use Illuminate\Support\Facades\Input;
use SleepingOwl\Admin\Form\Element\Text;
use SleepingOwl\Admin\Form\Element\View;

class TranslatableTextArea extends Text
{
    protected $display;
    protected $data = [];
    protected $callback;
//    protected $required = false;
    /**
     * @param string $view
     * @param array $data
     * @param Closure $callback
     */
    public function __construct($path,$label='')
    {
//        AdminFormElement::view('admin::forms.name',['name'=>'name',  'label'=>'Name transl',
//            'attributes'=>AdminFormElement::text('name','fg')->getHtmlAttributes()], function(\Illuminate\Database\Eloquent\Model $model,  $request, $name='name'){
////                dd(Input::get()['name']);
//            foreach (Language::all() as $language) {
//                $model->{$name.':'.$language->code} = Input::get()[$name.':'.$language->code];
//            }
//            $model->save();
//        })
        $this->setLabel($label);
        $this->setPath($path);
        $this->setView('admin::forms.translatabletextarea');
        $data=['name'=>$path,  'label'=>$label
              //  'attributes'=>AdminFormElement::text('1','1')->getHtmlAttributes()
            ];
//        $view='admin::forms.translatabletext';
        $this->setData($data);
        $this->setCallback(function(\Illuminate\Database\Eloquent\Model $model,  $request){
            foreach (Language::all() as $language) {
                $model->{$this->getName().':'.$language->code} = strip_tags(Input::get()[$this->getName().':'.$language->code]);
            }
            //  $model->save();
        });
        parent::__construct($path,$label);
    }
    public function getValidationMessages()
    {
        $messages = parent::getValidationMessages();
//        dump($messages);
        $result = [];
        foreach (Language::all() as $language) {
        foreach ($messages as $rule => $message) {
//            dump($language->code);
//            dump($rule);
//            dump($message);
            //$messages[$this->getName().'.'.$rule] = $message;
            $result[
            str_replace($this->getName(),$this->getName().':'.$language->code,$rule)]= $message;
            //unset($messages[$rule]);
        }



        }
//        dump($result);
//            dd($messages);
        return $result;
    }
    public function getValidationRules()
    {
        $rules = parent::getValidationRules();

        foreach ($rules as &$rule) {
            if ($rule !== '_unique') {
                continue;
            }

            $model = $this->resolvePath();
            $table = $model->getTable();

            $rule = 'unique:'.$table.','.$this->getModelAttributeKey();
            if ($model->exists) {
                $rule .= ','.$model->getKey();
            }
        }
        unset($rule);
//        dump($rules);
        $result = [];
        foreach (Language::all() as $language) {
            $result[$this->getName().':'.$language->code]= $rules[$this->getName()];
        }
//        dump($result);
//                dd([$this->getPath() => $rules]);
        return $result;
    }
    /**
     * @return string
     */
    public function getDisplay()
    {
        if (is_callable($this->display)) {
            return call_user_func($this->display, $this->getModel());
        }

        if ($this->display instanceof Htmlable) {
            return $this->display->toHtml();
        }

        if ($this->display instanceof View) {
            return $this->display->with('model', $this->getModel())->render();
        }

        return $this->display;
    }

    /**
     * @param Closure|string|Htmlable|ViewContract $display
     *
     * @return $this
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    public function setView($view)
    {
        $this->view = $view;

        $this->setDisplay(function ($model) {
            $this->data['model'] = $model;

            return view($this->getView(), $this->data);
        });

        return $this;
    }

    /**
     * @return Closure
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param Closure $callback
     *
     * @return $this
     */
    public function setCallback(Closure $callback)
    {
        $this->callback = $callback;

        return $this;
    }
    /**
     * @return string
     */
//    public function getView()
//    {
//        return $this->view;
//    }
//    public function getLabel()
//    {
//        return $this->label;
//    }
//    public function getName()
//    {
//        return $this->name;
//    }
//    /**
//     * @param string $view
//     *
//     * @return $this
//     */
//    public function setName($name)
//    {
//        $this->name=$name;
//    }
//        public function setLabel($label)
//    {
//        $this->label=$label;
//    }
//    public function setView($view)
//    {
//        $this->view = $view;
//
//        $this->setDisplay(function ($model) {
//            $this->data['model'] = $model;
//
//            return view($this->getView(), $this->data);
//        });
//
//        return $this;
//    }

    /**
     * @param array $data
     *
     * @return $this
     */
//    public function setData(array $data)
//    {
//        $this->data = $data;
//
//        return $this;
//    }

    public function save(\Illuminate\Http\Request $request)
    {
        $callback = $this->getCallback();

        if (is_callable($callback)) {
            call_user_func_array($callback, [$this->getModel(), $request]);
        }
    }
}
