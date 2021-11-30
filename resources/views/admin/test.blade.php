
<html>
<head>
    <title>App Name - @yield('title')</title>
</head>
<body>

<form method="POST" action="commit">
    @csrf
    <p>First name: <input type="text" name="fname" /></p>
    <p>Last name: <input type="text" name="lname" /></p>
    <input type="submit" value="Submit" />
</form>


<div class="container">

</div>
</body>
</html>
<script>
    import Input from "@/Jetstream/Input";
    export default {
        components: {Input}
    }
</script>