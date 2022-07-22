<script>

    /* Start activate status */

    function check_status(path,msg){
        const href = path;
        swal({
            title: msg,
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = href
                } else {
                }
            });

    };

    /* End ativate status */

    /* Start confirm delete */

    function confirm_delete(path,msg,text){
        const href = path;
        swal({
            title: msg,
            text: text,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = href

                } else {
                }
            });
    };

    /* End confirm delete */
</script>
