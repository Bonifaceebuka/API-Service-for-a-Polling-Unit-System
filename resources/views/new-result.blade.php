@extends('layouts.app')
@section('title')
Add New Result
@endsection
@section('content')
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Add New Result</h2>
					</div>
                </div>
            </div>
            <form method="POST" id="new_score" action="#">
                @csrf
                <div class="modal-body">					
                    <div class="form-group">
                            <label>State</label>
                            <span class="state_err text-danger"></span>							
                            <select class="form-control" 
                            id="state" name="state">
                            @foreach($states as $state)
                                <option value="{{$state->state_id}}">{{$state->state_name}}</option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group lga_container">
                            <label>L.G.A</label> <em class="text-warning">Choose a state to activate this field</em>
                            <span class="lga_err text-danger"></span>							
                            <select class="form-control" 
                            id="lga" name="lga">
                            <option value="">--Local Govt. Area--</option>
                            </select>
                    </div>
                    <div class="form-group ward_container">
                            <label>Ward</label> <em class="text-warning">Choose a L.G.A to activate this field</em>
                            <span class="ward_err text-danger"></span>							
                            <select class="form-control" 
                            id="ward" name="ward">
                            <option value="">--Ward--</option>
                            </select>
                    </div>
                    <div class="form-group polling_unit_container">
                            <label>Polling Unit</label> <em class="text-warning">Choose a Ward to activate this field</em>
                            <span class="polling_unit_err text-danger"></span>							
                            <select class="form-control" 
                            id="polling_unit" name="polling_unit">
                            <option value="">--Polling Unit--</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label>Party</label>
                        <span class="party_err text-danger"></span>							
                        <select class="form-control" 
                        id="party" name="party">
                        @foreach($parties as $party)
                                <option value="{{$party->partyname}}">{{$party->partyname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                            <label>Party Score</label>
                            <span class="party_score_err text-danger"></span>
                            <input id="party_score" name="party_score" type="text" 
                            class="form-control" placeholder="Party Score">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Add" placeholder="Normal Price">
                </div>
            </form>
    </div>
    @endsection
    @section('extra-js')
    <script type="text/javascript">
        ///////Consuming the API using AJAX and JQuery
         $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        ////Listening to the SUBMIT event of the score registration form
        $('#new_score').on('submit', function(e){
            e.preventDefault();
            var party_score = $('#party_score').val();
            var polling_unit = $('#polling_unit').val();
            var state = $('#state').val();
            var lga = $('#lga').val();
            var ward = $('#ward').val();
            var party = $('#party').val();
            
            ////Stripping spaces to ensure that the user didn't only submit an input that contains only spaces
            party_score = party_score.replace(/^\s+/,'');
            polling_unit = polling_unit.replace(/^\s+/,'');
            state = state.replace(/^\s+/,'');
            lga = lga.replace(/^\s+/,'');
            ward = ward.replace(/^\s+/,'');
            party = party.replace(/^\s+/,'');
    
            ///////Clear the error displayed
            $('.party_score_err').html('')
            $('.polling_unit_err').html('')
            $('.state_err').html('')
            $('.lga_err').html('')
            $('.ward_err').html('')
            $('.party_err').html('')
            ///Input validation
            if(state.length == 0){
                $('.state_err').html('State is required!');
                return
            }
            else if(lga.length == 0){
                $('.lga_err').html('L.G.A is required!');
                return                
            }
            else if(ward.length == 0){
                $('.ward_err').html('Ward is required!');
                return                
            }
            else if(party.length == 0){
                $('.pary_err').html('Party is required!');
                return                
            }
            else if(polling_unit.length == 0){
                $('.polling_unit_err').html('Polling Unit is required!');
                return                
            }
            else if(party_score.length == 0){
                $('.party_score_err').html('Party Score is required!');
                return                
            }
            else if(Math.floor(party_score) != party_score || $.isNumeric(party_score) == false){
                // 
                $('.party_score_err').html('Party Score must be a valid integer!');
            }
            /////AJAX Call to Laravel API to create a new Item
            var formData = $(this).serialize();
            // console.log(formData)
            $.ajax(
            {
                url: "{{route('save_new_result')}}",
                type: 'POST',
                dataType: "JSON",
                data: formData,
                success: function(response)
                {
                    if(response.message && response.message == 'success'){
                    swal({
                    title: "New Score",
                    text: 'New Score Successfully Added!',
                    icon: 'success',
                    closeOnClickOutside: false,
                    });
                    }
                    else{
                    swal({
                    title: "New Score",
                    text: 'New Score Was Not Successfully Added!',
                    icon: 'error',
                    closeOnClickOutside: false,
                    });
                }
                }
               
            });
        });

    $('#state').on('change',function(e){
            e.preventDefault();
            var state_id = $(this).val();
            find_local_govt_area(state_id)
    });
    $(document).on('change','#lga',function(e){
            e.preventDefault();
            var lga_id = $('#lga').val();
            find_ward(lga_id);
    });
    $(document).on('change','#ward',function(e){
            e.preventDefault();
            var ward_id = $('#ward').val();
            find_polling_unit(ward_id);
    });
        function find_local_govt_area(state_id){
        // console.log(state_id)
        var input ='';
        var emt = '';
        var default_local_govt_area = '--Local Govt. Area--';
        $.post("{{route('find_lga')}}",
        {
        state_id:state_id
        },
        function(data){
                if(data.local_govt_area !== false){
                    var oldSel = $('#lga').get(0);
                    while (oldSel.options.length > 0) {
                        oldSel.remove(oldSel.options.length - 1);
                    }
                    var newSel = $('#lga').get(0);
                    for (var i = data.local_govt_area.length - 1; i >= 0; i--){
                    var opt = document.createElement('option');
                    opt.text = data.local_govt_area[i]['lga_name'];
                    opt.value = data.local_govt_area[i]['uniqueid'];//newSel.options[i].value;
                    oldSel.add(opt, null);
                }
                }
                else{
                    // console.log('kkk');
                    swal({
                    title: "No Records",
                    text: 'No Matching L.G.A Found',
                    icon: 'info',
                    closeOnClickOutside: false,
                    });
                    input +='<label>L.G.A</label><em class="text-warning">Choose a state to activate this field</em> <select name="lga" id="lga" class="listing-input hero__form-input  form-control custom-select" required>';
                    input +='<option value="'+emt+'">'+default_local_govt_area+'</option>';         
                    input +='</select>';
                    $('.lga_container').html('');
                    $('.lga_container').html(input);
                }
            });
    }

    function find_ward(lga_id){
        // console.log(state_id)
        var input ='';
        var emt = '';
        var default_ward = '--Ward--';
        $.post("{{route('find_ward')}}",
        {
        lga_id:lga_id
        },
        function(data){
                if(data.ward !== false){
                    var oldSel = $('#ward').get(0);
                    while (oldSel.options.length > 0) {
                        oldSel.remove(oldSel.options.length - 1);
                    }
                    var newSel = $('#ward').get(0);
                    for (var i = data.ward.length - 1; i >= 0; i--){
                    var opt = document.createElement('option');
                    opt.text = data.ward[i]['ward_name'];
                    opt.value = data.ward[i]['uniqueid'];//newSel.options[i].value;
                    oldSel.add(opt, null);
                }
                }
                else{
                    // console.log('kkk');
                    swal({
                    title: "No Records",
                    text: 'No Matching Ward Found',
                    icon: 'info',
                    closeOnClickOutside: false,
                    });
                    input +='<label>Ward</label><em class="text-warning">Choose a L.G.A to activate this field</em> <select name="ward" id="ward" class="listing-input hero__form-input  form-control custom-select" required>';
                    input +='<option value="'+emt+'">'+default_ward+'</option>';         
                    input +='</select>';
                    $('.ward_container').html('');
                    $('.ward_container').html(input);
                }
            });
    }

    function find_polling_unit(ward_id){
        // console.log(state_id)
        var input ='';
        var emt = '';
        var default_polling_unit = '--Polling unit--';
        $.post("{{route('find_polling_unit')}}",
        {
        ward_id:ward_id
        },
        function(data){
                if(data.polling_unit !== false){
                    var oldSel = $('#polling_unit').get(0);
                    while (oldSel.options.length > 0) {
                        oldSel.remove(oldSel.options.length - 1);
                    }
                    var newSel = $('#polling_unit').get(0);
                    for (var i = data.polling_unit.length - 1; i >= 0; i--){
                    var opt = document.createElement('option');
                    opt.text = data.polling_unit[i]['polling_unit_name'];
                    opt.value = data.polling_unit[i]['uniqueid'];//newSel.options[i].value;
                    oldSel.add(opt, null);
                }
                }
                else{
                    // console.log('kkk');
                    swal({
                    title: "No Records",
                    text: 'No Matching Polling unit Found',
                    icon: 'info',
                    closeOnClickOutside: false,
                    });
                    input +='<label>Polling_unit</label><em class="text-warning">Choose a L.G.A to activate this field</em> <select name="polling_unit" id="polling_unit" class="listing-input hero__form-input  form-control custom-select" required>';
                    input +='<option value="'+emt+'">'+default_polling_unit+'</option>';         
                    input +='</select>';
                    $('.polling_unit_container').html('');
                    $('.polling_unit_container').html(input);
                }
            });
    }
</script>
@endsection