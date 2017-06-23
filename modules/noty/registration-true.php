    <script type="text/javascript">
         function generate(type, text) {

            var n = noty({
                text: text,
                type: type,
                dismissQueue: true,
                layout: 'topLeft',
                closeWith: ['click'],
                theme: 'relax',
                maxVisible: 10,
                animation: {
                    open: 'animated bounceInLeft',
                    close: 'animated bounceOutLeft',
                    easing: 'swing',
                    speed: 500
                }
            });
            console.log('html: ' + n.options.id);
        }

        function generateAll() {
            generate('warning', notification_html[0]);
            generate('error', notification_html[1]);
            generate('information', notification_html[2]);
            generate('success', notification_html[3]);
            generate('notification');
            generate('success');
        }

        $(document).ready(function () {

            setTimeout(function () {
                generateAll();
            }, 500);

        });

    </script>