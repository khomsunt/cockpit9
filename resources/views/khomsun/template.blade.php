
@extends('layouts.app')

@section('content')
	<button id="div_new" type="button">div</button>
	<button id="input_text_new" type="button">input text</button>
	<button id="btn_new" type="button">button</button>

	<div id="main_con"></div>
	<div id="stand_in_store">
		<div id="stand_in"></div>
	</div>
	<div id="dialog" title="Basic dialog">
  		<p>This is an animated dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
	</div>


<!-- 	<div id="jsondata"></div>
	<div id="mpos">mpos</div>
	moving object<div id="moving_object"></div>
	container:<div id="opos">opos</div>
	insert_type:<div id="insert_type">insert_type</div>
	<div id="test"></div>
 -->
<script>
	var config_snap=5;
	var active_object = null;	
	var jsondata = {
		template : [
		{type : 'div', parent: 'main_con', prop:{attr: {id: 'div_main',class: 'container-fluid bg-warning'}, text:{text: 'div_main'}, css:{}}},
		{type : 'div', parent:'div_main', prop:{attr: {id: 'row1', class: 'row bg-info'}}},
		{type : 'div', parent:'row1', prop:{attr: {id: 'div1', class: 'col-lg-9 col-sm-12'}, text:{text: 'div1'}, css:{border: '3px solid green'}}},
		{type : 'div', parent:'row1', prop:{attr: {id: 'div2', class: 'col-lg-3 col-sm-12'}, text:{text: 'div2'}, css:{border: '3px solid blue'}}},
		{type : 'p', parent:'div2', prop:{attr: {id: 'p1_div2'}, text:{text: 'p1_div2'}, css:{border: '3px solid red'}}},
		{type : 'input', parent:'div_main', caption:'username',  prop:{attr: {id: 'fname',type: 'text', title: 'Enter your name.',placeholder: 'First name'}, css:{}}},
		{type : 'input', parent:'div_main',caption: 'lastname', prop:{attr: {id: 'lname',type: 'text'}, val:{val: 'rugsasang'}}},
		{type : 'input', parent:'div2', caption:'วันเกิด', prop:{attr: {id: 'birthdate',type: 'date'}, val:{val: '1969-04-06'}, css:{}}},
		{type : 'input', parent:'div2', prop:{attr: {id: 'btn_save',type: 'submit'}, val:{val: 'Save'}, css:{width: '60px'}}},
		{type : 'div', parent:'div_main', prop:{attr: {id: 'div3', class: 'row'}, text:{text: 'div3'}}},
		{type : 'div', parent:'div3', prop:{attr: {id: 'div4', class: 'col-sm-12 bg-primary text-center'}, text:{text: 'div4'}}}

		], 
		data : { id: 'yyy'}};

		var div_template={type : 'div', parent:'div_main', prop:{attr: {id: 'div5', class: 'col-sm-12 bg-primary text-center'}, text:{text: 'div5'}}};
		var input_text_template={type : 'input', parent:'div_main', caption:'label',  prop:{attr: {id: 'text1',type: 'text', title: 'Enter your text.',placeholder: 'text'}, css:{}}};
		var btn_template={type : 'input', parent:'div_main', prop:{attr: {id: 'btn1',type: 'button'}, val:{val: 'Btn1'}, css:{width: '60px'}}};



		var dragOption={
				start: function(e){
					var this_obj=getObjSelection(e);
					drag_object=$(this_obj).attr("id");
					$("#moving_object").html(drag_object);
					setActive($(this_obj));
					$("#stand_in").addClass("stand_in");					
					$("#stand_in").width('0px');
					$("#stand_in").height('0px');
					target = null;
					insert_type = '';
				},
				drag: function(e) {

					drag_status = true;
					//alert(drag_status);
					$("#mpos").html(e.pageX);
					$.each($(".draggable"),function(){
//						$("#opos").html($("#opos").html()+" | "+$(this).attr("id")+"x="+$(this).position().left);
						var offset=$(this).offset();
						if (($(this).attr('id')!=undefined) && ($(this).attr("id")!=drag_object)){
							if ((e.pageX>=offset.left) && (e.pageX<=offset.left+$(this).width()) && (e.pageY>=offset.top) && (e.pageY<=offset.top+$(this).height())){
								target=$(this);
//alert(target.attr('id'));								
							}
						}


					});

					offset=target.offset();
					$('#opos').html(drag_object+"->"+target.attr("id")+" X="+e.pageX+" Y="+e.pageY+" XY1="+offset.left+","+offset.top+" XY2="+(offset.left+target.width())+","+(offset.top+target.height()));
					
					insert_type=(e.pageY-offset.top<=config_snap)?"upper":(((offset.top+target.height())-e.pageY<=config_snap)?"lower":"in");
					$("#insert_type").html(insert_type);
					$("#stand_in").width(($("#"+drag_object).width()>$(target).width())?$(target).width():$("#"+drag_object).width());
					$("#stand_in").height($("#"+drag_object).height());
					if (insert_type=='upper'){
						$("#stand_in").insertBefore($(target));
					}else if(insert_type=='in'){
						$("#stand_in").appendTo($(target));						
					}else if(insert_type=='lower'){
						$("#stand_in").insertAfter($(target));						
					}else{						
						$("#stand_in").width('0px');
						$("#stand_in").height('0px');
					}

				},
				stop: function(e) {

					$("#"+drag_object).removeClass("draged");
					if (insert_type=='upper'){
						$("#"+drag_object).insertBefore($(target));						
					}else if (insert_type=='in') {
						$("#"+drag_object).appendTo($(target));
					}else if (insert_type=='lower') {
						$("#"+drag_object).insertAfter($(target));
					}
					$("#"+drag_object).css("position","initial");
					// $("#"+drag_object).css("position","absolute");

					$("#stand_in").width('0px');
					$("#stand_in").height('0px');
					$("#stand_in").removeClass('stand_in');
					$("#stand_in").appendTo($("#stand_in_store"));
					drag_status = false;
					drag_object = null;

					// counts[ 2 ]++;
					// updateCounterStatus( $stop_counter, counts[ 2 ] );
				}
			};




		var dwardObj = function(params){
			var var_param='';
			$.each(params,function(key,value){
				if (typeof(value)=='object'){
					var_param+="this."+key+"="+JSON.stringify(value)+";";
				}else{
					var_param+="this."+key+"='"+value+"';";
				}
			});
			eval(var_param); 
			this.create1 = function(){
				var new_div=document.createElement(this.type);
				$.each(this.prop,function(key,value){
					$.each(value,function(k,v){
						if (key==k){
							var prop="$(new_div)."+key+"('"+v+"')";
						}else{
							var prop="$(new_div)."+key+"('"+k+"','"+v+"')";
						}
						eval(prop);
					});
				});
				if(this.type == 'input'){
					$(new_div).attr('class','form-control');

					if(this.caption != undefined){
						var form_group_div = document.createElement('div');
						$(form_group_div).attr('class','form-group row');
						var form_group_label = document.createElement('label');
						$(form_group_label).text(this.caption);
						$(form_group_label).attr('for',this.prop.attr.id);
						$(form_group_label).attr('class','col-form-label');

						$(form_group_div).addClass('draggable');
						$(form_group_div).attr("id",$(new_div).attr("id")+"_form_group_div");
						$(form_group_label).appendTo(form_group_div);
						$(new_div).appendTo(form_group_div);
						$(form_group_div).draggable(dragOption);
						$(form_group_div).attr("objectType",this.type);
						return form_group_div;
					}else{
						$(new_div).addClass('draggable');
						$(new_div).draggable(dragOption);
						$(new_div).attr("objectType",this.type);
						return new_div;
					}
				}else{
					$(new_div).addClass('draggable');
					$(new_div).draggable(dragOption);
					$(new_div).attr("objectType",this.type);
					return new_div;
				}

			};
			this.getId = function(){
				console.log(this.id);
			};
			this.getType = function(){
				return this.type;
			}
		}

		$.each(jsondata.template,function(key,value){
			let dwardObjId=this.prop.attr.id;
			let newDwardObjId = "var "+dwardObjId+" = new dwardObj(this);";
			eval(newDwardObjId);
			$(eval(dwardObjId).create1()).appendTo((this.parent=='')?"body":$("#"+this.parent));
		});

		$(function(){
			var drag_status = false;
			var drag_object = null;
			var target = null;
			var insert_type = '';
		    $( "#dialog" ).dialog({
		      autoOpen: false,
		      show: {
		        effect: "blind",
		        duration: 1000
		      },
		      hide: {
		        effect: "explode",
		        duration: 1000
		      }
		    });
		 
		    $(".draggable").dblclick(function(e) {
		    	var this_obj=getObjSelection(e);
		    	$("#test").html("dbl_object="+$(this_obj).attr('id'));
		    	$("#dialog").dialog( "open" );
		    });
		    $(".draggable").click(function(e) {
		    	var this_obj=getObjSelection(e);
		    	$("#test").html("click="+$(this_obj).attr('id'));
		    	setActive(this_obj);
		    });
		    $("#input_text_new").click(function(){
				var obj1 = "var div1 = new dwardObj(input_text_template);";
				eval(obj1);
				let this_obj=div1.create1();
				if ($(active_object).attr("objectType")=='div'){
					$(this_obj).appendTo(active_object);
				}else{
					if ($(active_object).attr("objectType")==undefined){
						$(this_obj).appendTo((input_text_template.parent=='')?"body":$("#"+input_text_template.parent));
					}else{
						$(this_obj).insertAfter($(active_object));
					}
				}
				active_object=this_obj;
				setActive(active_object);

			});
		    $("#btn_new").click(function(){
				var obj1 = "var div1 = new dwardObj(btn_template);";
				eval(obj1);
				console.log(div1.create1());
				$(div1.create1()).appendTo((btn_template.parent=='')?"body":$("#"+btn_template.parent));
			});
		});
		function setActive(obj){
			$("*").removeClass("draged");
			$(obj).addClass("draged");
			active_object=obj;
			//alert("onclick="+$(obj).attr("id"));
		}
		function getObjSelection(e){
	    	var dbl_object=null;
			$.each($("*"),function(){
//alert("object list="+$(this).attr("id"));
				var offset=$(this).offset();
				if ($(this).attr('id')!=undefined){
					if ((e.pageX>=offset.left) && (e.pageX<=offset.left+$(this).width()) && (e.pageY>=offset.top) && (e.pageY<=offset.top+$(this).height())){
						//alert("object clicked="+$(this).attr("id"));
						dbl_object=$(this);
					}
				}
			});
			return dbl_object;			
		}
	</script>
	@endsection