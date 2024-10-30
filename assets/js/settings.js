jQuery(function($){
	
    class JT_WCFSB_admin_Settings {

        constructor(){
            this.__this;
            this.eventHandlers();
        }

        eventHandlers(){
            $(document.body).ready( this.init_colorcode() );
            $(document.body).on(  "click", "input.reset_val", this.reset_option_report.bind(this) );
        }

        init_colorcode(e){
            $(".wpk-colorpicker").wpColorPicker();
        }

        reset_option_report(e){
            e.preventDefault();
            var _this = $( e.currentTarget );
                
            _this.siblings( 'input[type="number"]' ).val(0);
        }
    }

    new JT_WCFSB_admin_Settings();
});