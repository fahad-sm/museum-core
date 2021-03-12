student_wp.alpine.subscription_form = {
	loading: false,
	submitForm(e, b) {
		var $ = jQuery

		this.loading = true
		console.log(this.loading)

		var form = new FormData(this.$refs.form);
		// var $this = $(e.target);
		var error = $(e.target).data('error')

		form.append('action', 'student_elementor_form_handler');

		$.ajax({
			url: webinane_elementor_util.ajaxurl,
			type: 'post',
			enctype: 'multipart/form-data',
			cache: false,
			data: form,
			success: (res) => {
				if ( res.success ) {
					this.notify({type:'success', title: 'Success', message: res.data.message})
				} else {
					this.notify({message: res.data.message})
				}
			},
			fail: (res) => {
				if ( res.success === false ) {
					this.notify({message: res.data.message})
				}
			},
			complete: (res) => {
				this.loading = false
				if( res.status !== 200 ) {
					var message = (res.responseJSON.data.message !== undefined) ? res.responseJSON.data.message : res.responseText
					this.notify({message})
				}
			}
		})
	},
	notify(res) {
        var def = {
            title: 'Error',
            type: 'error',
            message: ''
        }
        def = jQuery.extend(def, res)
        var classs = (def.type == 'error') ? 'red' : 'green'
        var content = `
                <div class="wrapper">
                    <div class="fixed bg-${classs}-500 shadow rounded px-8 py-4" style="top: 45px; right: 0; width:30%">
                        <h3 class="text-white">${def.title}</h3>
                        <p class="text-white">${def.message}</p>
                    </div>
                </div>
            `
        jQuery('<div />', {
                style: 'display:none'
            })
            .html(content)
            .appendTo(jQuery('body'))
            .fadeIn('slow',
                function () {
                    var el = jQuery(this);
                    setTimeout(function () {
                        el.fadeOut('slow',
                            function () {
                                jQuery(this).remove();
                            });
                    }, 4500);
                });
    },
}
