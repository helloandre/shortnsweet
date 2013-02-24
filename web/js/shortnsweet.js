(function($){
    var SnS = {
        url: '/shortnsweet/up',
        entered_class: 'drop-hover',
        $dropzone: null,
        $url: null,
        $url_button: null,
        $action_drag: null,
        $action_drop: null,
        $uploaded: null,
        templates: {
            uploaded_img: '<div class="uploaded"><a href="%url%"><img src="%long%"></a><a href="%url%"><div class="name">%name%</div></a></div>',
            uploaded_url: '<div class="uploaded"><a href="%url%"><div class="name">%long%</div></a></div>'
        },
        init: function() {
            this.$dropzone = $('#dropzone')
                .on('dragenter', this.drag_enter.bind(this))
                .on('dragleave', this.reset.bind(this))
                .on('drop', this.reset.bind(this));
                
            $('#dropzone').data('dropzone')
                .on('success', this.build_img.bind(this))
                .on('error', this.error.bind(this));
                
            this.$action_drag = $('#action-drag');
            this.$action_drop = $('#action-drop');
            this.$uploaded = $('#uploaded');
            this.$url = $('#url-input');
            this.$url_button = $('#upload-button');
            
            // uploading binds
            this.$url_button.on('click', this.upload_url.bind(this));
        },
        upload_url: function(e) {
            var that = this;
            
            $.post(this.url, {
                url: this.$url.val()
            }, function(data) {
                if (data.success) {
                    that.build_url(data);
                } else {
                    alert(data.error);
                }
            })
        },
        build_img: function(file, data) {
            var $img = this.templates.uploaded_img;
            $img = $img.replace(/%long%/g, data.long);
            $img = $img.replace(/%name%/g, data.name);
            $img = $img.replace(/%url%/g, data.url);
            
            this.$uploaded.append($img);
        },
        build_url: function(data) {
            var $url = this.templates.uploaded_url;
            $url = $url.replace(/%long%/g, data.long);
            $url = $url.replace(/%url%/g, data.url);
            
            this.$uploaded.append($url);
        },
        drag_enter: function(e) {
            this.$dropzone.addClass(this.entered_class);
            this.$action_drag.hide();
            this.$action_drop.show();
        },
        reset: function() {
            this.$dropzone.removeClass(this.entered_class);
            this.$action_drag.show();
            this.$action_drop.hide();
        },
        error: function(file, data) {
            alert(data.error);
        }
    };
    
    $(function(){
        SnS.init();
    });
    
})(jQuery);