<template>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="box">
        <form @submit.prevent="submitForm" class="form-container">
            <div class="form-item">
                <label for="name">用户名：</label>
                <input id="name" type="text" v-model="formData.name" placeholder="请输入用户名">
            </div>
            <div class="form-item">
                <label for="password">密码：</label>
                <input id="password" type="password" v-model="formData.password" placeholder="请输入密码">
            </div>
            <div class="form-actions">
                <!-- 登录按钮 -->
                <el-button type="primary" native-type="submit" @click="handleLogin">登录</el-button>
                <!-- 注册按钮 -->
                <el-button @click="redirectToRegister">注册</el-button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                formData: {
                    name: '',
                    password: ''
                }
            };
        },
        methods: {
            submitForm() {
                // 获取 csrf-token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                axios.post('http://127.0.0.1:8000/api/sgnin', this.formData, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                    .then(response => {
                        // 登录成功后的处理逻辑
                        console.log('登录成功', response.data);
                        // 例如，跳转到首页
                        this.$router.push('/xyxw');
                    })
                    .catch(error => {
                        // 登录失败后的处理逻辑
                        console.error('登录失败', error);
                        alert('登录失败，请检查用户名和密码');
                    });
            },
            redirectToRegister() {
                // 跳转到注册页面
                this.$router.push('/register');
            }
        }
    };
</script>
<style scoped>
    @import "../assets/css/data.css";
    @import "../assets/css/login.css";
</style>
