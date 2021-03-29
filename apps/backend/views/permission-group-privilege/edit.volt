
<section class="content">
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title">{{ language._('information') }}</h3>
    </div>
    {{ form('class': 'form-horizontal') }}
        <div class="box-body">
            <table class="table table-striped responsive-utilities jambo_table table-permission"> 
                <thead> 
                    <tr> 
                        <th>{{ language._('name') }}</th> 
                        <th>{{ language._('privilege') }}</th>
                        {% for v in action %}
                            <th>{{ v }}</th>
                        {% endfor %} 
                    </tr> 
                </thead>
                <tbody> 
                    {% for key,value in role_view %}
                        <tr>
                            <td rowspan="{{ pri_active|length + 1 }}">{{ key }}</td>
                        </tr>
                        {% for k_1,v_1 in pri_active %}
                            <tr>
                                <td>{{ k_1 }}</td>
                                {% for k_action,v_action in action %}
                                    <td>
                                        <?php if(array_key_exists($k_1,$value) && array_key_exists($k_action, $value[$k_1])): ?>
                                            <input class="icon_checkbox" type="checkbox" name="my[<?= $k_1?>][<?= $k_action ?>]" data-size="mini" checked >
                                        <?php else: ?>
                                            <input class="icon_checkbox" type="checkbox" name="my[<?= $k_1?>][<?= $k_action ?>]" data-size="mini" >
                                        <?php endif; ?>
                                    </td>
                                {% endfor %}
                            </tr>
                        {% endfor %}
                    {% endfor %}
                </tbody> 
            </table>
        </div>

        <div class="box-footer">
            <div class="col-md-2 col-sm-2 col-xs-12"></div>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <button id="send" type="submit" class="btn btn-info">{{ language._('submit') }}</button>
                <button onclick="goBack()" class="btn btn-default pull-right">{{ language._('back') }}</button>
            </div>
        </div>
    </form>
    </div>
</section>
<script type="text/javascript">

    $(document).ready(function(){ 
        $("input.icon_checkbox").bootstrapSwitch();
    });    
</script>

