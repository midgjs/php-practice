<?php

//이 코드는 "class FormHelper" 선언 다음에 들어간다.
//다음 배열은 원소를 특정하고 어떤 속성에 어떤 값을 허용할지 결정한다.
protected $allowedAttributes = ['button' => ['type' => ['submit',
                                                        'reset',
                                                        'button'
                                            ]]];

//tag()를 고쳐 $this->attributes()의 첫 번쨰 인수로 $tag를 전달한다.
public function tag($tag, $attributes = array(), $isMultiple = false) {
    return "<$tag {$this->attributes($tag, $attributes, $isMultiple)} />";
}

//start()
public function start($tag, $attributes = array(), $isMultiple = false) {
    //select태그와 textarea 태그는 value 속성이 없다.
    $valueAttribute = (! (($tag == 'select') || ($tag == 'textarea')));
    $attrs = $this->attributes($tag, $attributes, $isMultiple, $valueAttribute);
    return "<$tag $attrs>";
}

//attributes()
//$this->allowedAttributes에 허용된 속성이면 attributeCheck 설정

protected function attributes($tag, $attributes, $isMultiple, $valueAttribute=true) {
    $tmp = array();
    if($valueAttribute && isset($attributes['name']) && array_key_exists($attributes['name'], $this->values)) {
        $attributes['value'] = $this->values[$attributes['name'];]
    }
    if(isset($this->allowedAttributes[$tag])) {
        $attributeCheck = $this->allowedAttributes[$tag];
    } else {
        $attributeCheck = array();
    }

    foreach($attributes as $k => $v) {
        if(isset($attributeCheck[$k]) && (! in_array($v, $attributeCheck[$k]))) {
            throw new
            InvalidArgumentException("$v 는 $k 에 허용되지 않는 값입니다.");
        }
        //참 값은 불리언 속성을 의미한다.
        if(is_bool($v)) {
            if($v) {
                $tmp[] = $this->encode($k);
            }
        }    
        else {
            $value = $this->encode($v);
            //다중 값이 지정된 원소라면,
            //name 값 뒤에 []를 붙인다.
            if($isMultiple && ($k == 'name')) {
                $value .= '[]';
            }
            $tmp[] = "$k=\"$value\"";
        }        
    }
    return implode(' ', $tmp);
}



















?>