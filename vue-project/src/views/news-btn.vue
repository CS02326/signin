<template>
    <div class="publish-news-container">
        <!-- 发布新闻表单 -->
        <h2>发布新闻</h2>

        <div v-if="message" :class="['message', messageType]">
            {{ message }}
        </div>

        <form @submit.prevent="publishNews">
            <div class="form-group">
                <label for="title">新闻标题:</label>
                <input
                        type="text"
                        id="title"
                        v-model="news.title"
                        placeholder="请输入新闻标题"
                        required
                />
            </div>

            <div class="form-group">
                <label for="content">新闻内容:</label>
                <textarea
                        id="content"
                        v-model="news.content"
                        placeholder="请输入新闻内容"
                        rows="5"
                        required
                ></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">发布新闻</button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'PublishNews',
        data() {
            return {
                news: {
                    title: '',
                    content: ''
                },
                message: '',
                messageType: ''
            };
        },
        methods: {
            async publishNews() {
                try {
                    // 发送发布新闻请求
                    const response = await axios.post('http://127.0.0.1:8000/api/news', this.news);

                    // 如果成功发布新闻
                    if (response.status === 201) {
                        // 更新消息状态
                        this.message = '新闻发布成功！';
                        this.messageType = 'success';

                        // 弹出成功提示
                        alert(response.data.message);

                        // 跳转到新闻列表页面 /xyxw
                        this.$router.push('/store');
                    } else {
                        // 如果请求没有成功，给出失败提示
                        this.message = '发布新闻失败，请稍后再试。';
                        this.messageType = 'error';
                    }
                } catch (error) {
                    // 处理请求失败的情况
                    this.message = '发布新闻失败，请稍后再试。';
                    this.messageType = 'error';
                    console.error(error);
                }
            }
        }
    };
</script>

<style scoped>
    .publish-news-container {
        width: 50%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-size: 16px;
        margin-bottom: 5px;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    textarea {
        resize: vertical;
    }

    button.submit-btn {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button.submit-btn:hover {
        background-color: #45a049;
    }

    .message {
        padding: 10px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
    }

    .message.success {
        background-color: #d4edda;
        color: #155724;
    }

    .message.error {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>
