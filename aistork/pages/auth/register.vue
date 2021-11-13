<template>
    <AuthRegister />
</template>

<script>
export default {
    layout: "empty",
    auth: 'guest',
    middleware: 'auth'
}
</script>