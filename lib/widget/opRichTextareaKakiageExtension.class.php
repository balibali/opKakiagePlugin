<?php

class opRichTextareaKakiageExtension extends opWidgetFormRichTextareaOpenPNEExtension
{
  static public function getButtons()
  {
    return array(
      'op_kakiage_copy_from_previous_day' => array(
        'caption' => 'Copy from previous day',
        'imageURL' => image_path('/opKakiagePlugin/images/deco_op_kakiage_copy_from_previous_day.png'),
      ),
      'op_kakiage_nocall' => array(
        'caption' => '%nocall',
        'imageURL' => image_path('/opKakiagePlugin/images/deco_op_kakiage_nocall.png'),
      ),
    );
  }

  static public function getButtonOnClickActions()
  {
    return array(
      'op_kakiage_copy_from_previous_day' => 'var a=$("#kakiage_body"),b=$("textarea.kakiage_body").val();a.val(a.val()+"\n"+b);',
      'op_kakiage_nocall' => 'var a=$("#kakiage_body");a.val("%%nocall"+"\n"+a.val());',
    );
  }
}
