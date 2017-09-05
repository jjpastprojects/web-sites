<script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>

<script language="javascript" type="text/javascript">
tinyMCE.init({
    selector: ".editor",
    plugins: "image, code, autoresize",
    image_list: [
        @foreach($images as $image)
        {title: "{{$image['name']}}", value: "{{$image['webPath']}}" },
        @endforeach
    ]
});
</script>
