// requires jquery
// common controls

// select

function getSelectSelectedText(selectBox)
{
    return selectBox.selectedIndex == -1 ? null : selectBox.options[selectBox.selectedIndex].text;
}

function getSelectSelectedValue(selectBox)
{
    return selectBox.selectedIndex == -1 ? null : selectBox.options[selectBox.selectedIndex].value;
}


document.createSelectOption = function(name, value)
{
    elem = document.createElement('option');
    $(elem).attr('value', value);
    $(elem).text(name);
    return elem;
};

document.createSelectOptionGroup = function(name)
{
    elem = document.createElement('optgroup');
    $(elem).attr('label', name);
    return elem;
};

(function($){

    // if required, call a constructor for each object
    // if not, return the objects
    $.fn.seavanControl = function(tagName, creator){

        this.not(this.has(tagName)).empty().append('<' + tagName + '></' + tagName + '>').children(tagName).each(creator);
        return this.children(tagName);
    };



    $.fn.jsonSelect = function(options) {       
        var opts = $.extend({}, $.fn.jsonSelect.defaults, options);
        
        return this.seavanControl("select",
        function()
        {
            $(this).attr('size', opts.size);
            if(opts.multiple) $(this).attr('multiple');
            this.clear = function() {
                
            };
            
            this.populateItem = opts.populateItem;

            this.getUpdateUrl = opts.getUpdateUrl;

            if(opts.update_url) this.getUpdateUrl = function() {
                return opts.update_url;
            };
        });
    };

    $.fn.jsonGrid = function(options) {
        var opts = $.extend({}, $.fn.jsonSelect.defaults, options);

        return this.seavanControl("div",
        function()
        {
            this.clear = function() {

            };

            this.populateItem = opts.populateItem;

            this.getUpdateUrl = opts.getUpdateUrl;

            if(opts.update_url) this.getUpdateUrl = function() {
                return opts.update_url;
            };
        });
    };

    $.fn.jsonUpdate = function(){

        return this.each( function() {
            
            if(this.getUpdateUrl)
            {
                
                callback = function(_data) {
                    item = this.related;
                    $(item).empty();
                    data = _data.result;
                    res = '';
                    for(i = 0; i < data.length; ++i)
                    {

                        if(item.populateItem)
                        {
                            item.populateItem(data[i]);
                            res += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                        }
                        else
                        {
                            alert('no populateItem specified');
                        }
                    }
                    $('#rubric_objects').html(res);
                };
                $.ajax({
                    url: this.getUpdateUrl(),
                    dataType: 'json',
                    data: null,
                    related: this,
                    success: callback
                });
                
            }
            else
            {
                alert('no getUpdateUrl specified');
            }
            return $();
        });
    };

    $.fn.jsonSelect.defaults = {
        size: 10,
        multiple: false

    };



    $.fn.controlAction = function(actionName) {
        return this.each( function() {
            if(this[actionName])
                this[actionName]();
            return $();
        });
    };

    $.fn.seavanSelectControl = function(options) {
        var opts = $.extend({}, $.fn.seavanSelectControl.defaults, options);        
        return this.jsonSelect( opts );
    };

    $.fn.seavanSelectControl.defaults = {
        populateItem: function(_data)
        {
            $(this).append(document.createSelectOption(_data.caption, _data.id));
        }};

    $.fn.seavanRubricControl = function(options) {
        var opts = $.extend({}, $.fn.seavanRubricControl.defaults, options);
        return this.jsonSelect( opts );
    };

    $.fn.seavanRubricControl.defaults = {
        populateItem: function(_data)
        {
            if(_data.rubric_id != null)
            {
                $(this).append(document.createSelectOption(_data.name, _data.id));
            }
            else
            {
                $(this).append(document.createSelectOptionGroup(_data.name));
            }
        }};



})(jQuery);