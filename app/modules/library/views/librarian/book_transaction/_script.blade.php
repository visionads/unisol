{{ HTML::script('assets/etsb/etsb_js/jquery/jquery.min.js')}}
{{ HTML::script('assets/etsb/etsb_js/jquery-ui/jquery-ui.min.js')}}

<script type="text/javascript">
    $(function(){

    /*=================================Ajax delete in popup========================================*/

    function deleteNearestTr(getId, detailsId)
    {
        var detail_id = detailsId;
        var url = '{{URL::to('fees/detail/applicantdelete/ajax')}}' ;
        console.log(url);
        if(detail_id > 0){
            var check = confirm("Are you sure to delete this item??");
            if(check)
            {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {billing_applicant_detail_id: detail_id}
                })
                        .done(function(msg) {
                            console.log(msg);
                            var whichtr = $('#'+getId).closest("tr");
                            whichtr.fadeOut(500).remove();
                        });
            }
            else
            {
                return false;
            }

        }else{
            var whichtr = $('#'+getId).closest("tr");
            whichtr.fadeOut(500).remove();
            // arrayItems.pop(getId);//To stop additem if exist
        }
    }


</script>
