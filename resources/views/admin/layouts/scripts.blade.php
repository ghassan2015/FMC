<script>

    function exportWithFilters(buttonId, routeName, filters = {}) {
        $(buttonId).on('click', function(e) {
            e.preventDefault();

            console.log(filters);
            const url = new URL(routeName, window.location.origin);

            Object.entries(filters).forEach(([paramName, source]) => {
                let value;

                if (typeof source === 'string' && source.startsWith('#')) {
                    // إذا كان selector مثل "#input_id"
                    value = $(source).val();
                } else {
                    value = source;
                }

                if (value !== null && value !== undefined && value !== '') {
                    url.searchParams.set(paramName, value);
                }
            });


            window.location.href = url.toString();
        });
    }
</script>
