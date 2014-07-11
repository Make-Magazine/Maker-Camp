<?


function create_maker_modal($maker) {
  $str = '
  <div class="modal fade" id="'.$maker->post_name.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #21396F;">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><!--span class="sr-only">Close</span--></button>
          <h4 class="modal-title" id="myModalLabel">
            <div class="modal-subtitle" 
            style="font-size: 10pt;
            color: rgb(181, 184, 255);
            font-weight: 100;">About This Maker</div>
            <div class="modal-maker-name" style="color: #FFF;">'.$maker->post_title.'</div>
          </h4>
        </div>
        <div class="modal-body">
  ';
  $image = get_the_post_thumbnail( $maker->ID, 'thumbnail');
  $str .= '<div class="image" style="float: left; margin-right: 10px;">'.$image.'</div>';
  $link = get_post_meta( $maker->ID, 'maker-hyperlink', true );
  $str .= '
          <div class="bio" style="overflow: hidden; margin-bottom: 20px;">
            '.$maker->post_content.'
            <div class="bio-link"><a href="'.$link.'" target="_blank">Click here to find out more.</a></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <!--button type="button" class="btn btn-primary">Save changes</button-->
        </div>
      </div>
    </div>
  </div>
  ';
  return $str;
}

?>
