<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{ language._('reset_password') }} <b>{{ username }}</b></h3>
    </div>
    <div class="panel-body">
   		{{ form('class': 'form-horizontal form-label-left','novalidate':'') }}
			<p style="height:10px"></p>
	        
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{ language._('password_new') }} <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	                {{ form.render('password_new',(['class':'form-control col-md-7 col-xs-12','data-validate-length-range':'2','placeholder':language._('password_new'),'required':'required'])) }}
	            </div>
	        </div>
	        
	        <div class="ln_solid"></div>
	        <div class="form-group">
	            <div class="col-md-6 col-md-offset-3">
	                <button onclick="goBack()" class="btn btn-primary">{{ language._('back') }}</button>
	                <button id="send" type="submit" class="btn btn-success">{{ language._('submit') }}</button>
	            </div>
	        </div>
	    </form>
    </div>
</div>