function validate(data)
{
    "use script";
    $.ajax({
        type: 'POST',
        url: '/hTwentyForty/answers/validate',
        dataType: 'json',
        data: data,
        success: function (data)
        {
            if(!data.response)
            {
                $('#div-round-view-content').prepend('<div class="error message", onclick="this.classList.add(\'hidden\')"> Values inserted does not match</div>')
                $("#div-round-view-content").scrollTop($("#div-round-view-content")[0].scrollHeight);
            }else
            {
                $('#form-round').submit();
            }
        }
    });
}
