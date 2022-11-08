<?php


public function testButtonNoTypeOK() {
    $from = new FormHelper();
    $html = $form->tag('button');
    $this->assertEquals('<button />',$html);
}

public function testButtonTypeSubmitOK() {
    $from = new FormHelper();
    $html = $form->tag('button',['type'=>'submit']);
    $this->assertEquals('<button type="submit" />',$html);
}

public function testButtonTypeResetOk() {
    $from = new FormHelper();
    $html = $form->tag('button',['type'=>'reset']);
    $this->assertEquals('<button type="reset" />',$html);
}

public function testButtonTypeButtonOK() {
    $from = new FormHelper();
    $html = $form->tag('button',['type'=>'button']);
    $this->assertEquals('<button type="button" />',$html);
}

public function testButtonTypeOtherFails() {
    $from = new FormHelper();
    $this->setExpectedException('InvalidArgumentException');
    $html = $form->tag('button',['type' => 'other']);
}



















?>