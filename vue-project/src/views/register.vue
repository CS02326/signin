<template>
    <div class="register-form">
        <h2>用户注册</h2>
        <form @submit.prevent="handleSubmit">
            <div>
                <label for="name">用户名</label>
                <input
                        type="text"
                        id="name"
                        v-model="name"
                        required
                        placeholder="请输入用户名"
                />
            </div>
            <div>
                <label for="email">邮箱</label>
                <input
                        type="email"
                        id="email"
                        v-model="email"
                        required
                        placeholder="请输入邮箱"
                />
            </div>
            <div>
                <label for="password">密码</label>
                <input
                        type="password"
                        id="password"
                        v-model="password"
                        required
                        placeholder="请输入密码"
                />
            </div>
            <div>
                <label for="passwordConfirmation">确认密码</label>
                <input
                        type="password"
                        id="passwordConfirmation"
                        v-model="passwordConfirmation"
                        required
                        placeholder="请确认密码"
                />
            </div>
            <button type="submit">注册</button>
        </form>

        <div v-if="errorMessage" class="error-message">
            <p>{{ errorMessage }}</p>
        </div>
    </div>
</template>


<script>
    import axios from 'axios'; // 导入 axios
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                passwordConfirmation: '',
                errorMessage: '',
            };
        },
        methods: {
            async handleSubmit() {
                // 清空上次的错误信息
                this.errorMessage = '';

                // 准备发送的数据
                const requestData = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation, // 确认密码
                };
                try {
                    // 发送 POST 请求到后端注册接口
                    const response = await axios.post(
                        'http://127.0.0.1:8000/api/register', // 替换成你的后端注册接口 URL
                        requestData
                    );

                    // 注册成功后，处理成功的响应
                    alert(response.data.message);
                    this.$router.push('/')
                } catch (error) {
                    // 处理错误信息，显示给用户
                    if (error.response && error.response.data.errors) {
                        // 提取第一个错误信息并显示
                        this.errorMessage = Object.values(error.response.data.errors)[0][0];
                    } else {
                        this.errorMessage = '注册失败，请稍后重试。';
                    }
                }
            },
        },
    };
</script>

<style scoped>
    .register-form {
        width: 100%;
        max-width: 400px; /* 最大宽度设为400px */
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    form div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
    }

    button:hover {
        background-color: #45a049;
    }

    .error-message {
        color: red;
        text-align: center;
        margin-top: 15px;
    }

    /* 响应式调整 */

    /* 小屏幕（最大宽度500px） */
    @media (max-width: 500px) {
        .register-form {
            padding: 15px;
        }

        input {
            font-size: 14px; /* 输入框字体大小适应小屏幕 */
        }

        button {
            font-size: 14px; /* 按钮字体大小调整 */
        }

        h2 {
            font-size: 18px; /* 标题字体大小调整 */
        }
    }

    /* 中等屏幕（最大宽度768px） */
    @media (max-width: 768px) {
        .register-form {
            padding: 18px;
            border: none;

        }

        input {
            font-size: 15px; /* 输入框字体大小适中 */
        }

        button {
            font-size: 15px; /* 按钮字体大小适中 */
        }

        h2 {
            font-size: 20px; /* 标题字体大小适中 */
        }
    }

    /* 大屏幕（最小宽度769px） */
    @media (min-width: 769px) {
        .register-form {
            padding: 20px; /* 保持默认内边距 */
        }

        input {
            font-size: 16px; /* 输入框字体默认大小 */
        }

        button {
            font-size: 16px; /* 按钮字体默认大小 */
        }

        h2 {
            font-size: 24px; /* 标题字体大小默认 */
        }
    }
</style>

