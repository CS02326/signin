<template>
    <div class="news-container">
        <h2 class="title">最新新闻</h2>
        <div v-if="newsList && newsList.length > 0">
            <div v-for="newsItem in newsList" :key="newsItem.id" class="news-item">
                <h3 class="news-title">{{ newsItem.title }}</h3>
                <p class="news-content">{{ newsItem.content }}</p>
                <p class="news-time">{{ newsItem.created_at }}</p>

                <!-- 添加编辑和删除按钮 -->
                <button @click="openEditModal(newsItem)" class="edit-btn">编辑</button>
                <button @click="deleteNews(newsItem.id)" class="delete-btn">删除</button>

                <hr />
            </div>
        </div>
        <div v-else>
            <p class="no-news">暂无新闻</p>
        </div>
        <!-- 分页按钮 -->
        <div class="pagination">
            <button @click="changePage(currentPage - 1)" :disabled="currentPage <= 1">上一页</button>
            <button
                    v-for="page in totalPages"
                    :key="page"
                    @click="changePage(page)"
                    :class="{ active: page === currentPage }"
            >
                {{ page }}
            </button>
            <button @click="changePage(currentPage + 1)" :disabled="currentPage >= totalPages">下一页</button>
        </div>
        <!-- 编辑新闻模态框 -->
        <div v-if="isModalOpen" class="modal-overlay" @click="closeEditModal">
            <div class="modal-content" @click.stop>
                <h3>编辑新闻</h3>
                <label for="title">标题</label>
                <input v-model="editingNews.title" id="title" type="text" class="modal-input" />

                <label for="content">内容</label>
                <textarea v-model="editingNews.content" id="content" class="modal-textarea"></textarea>

                <div class="modal-actions">
                    <button @click="updateNews" class="save-btn">保存</button>
                    <button @click="closeEditModal" class="cancel-btn">取消</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                newsList: [],  // 存储新闻列表
                currentPage: 1,  // 当前页
                totalPages: 0,  // 总页数
                isModalOpen: false,  // 控制编辑模态框的显示
                editingNews: null,  // 正在编辑的新闻
                totalNewsCount: 0,  // 总新闻数量
                pageSize: 5,  // 每页显示的新闻数
            };
        },
        created() {
            this.fetchNews();  // 初始化时获取新闻数据
        },
        methods: {
            // 获取新闻数据，支持分页
            async fetchNews() {
                try {
                    const response = await fetch(`http://127.0.0.1:8000/api/news?page=${this.currentPage}&per_page=${this.pageSize}`);
                    const data = await response.json();

                    // 假设响应数据结构包含：newsList 和 pagination 信息
                    this.newsList = data.data;
                    this.totalNewsCount = data.total;
                    this.totalPages = Math.ceil(this.totalNewsCount / this.pageSize);  // 计算总页数
                } catch (error) {
                    console.error('获取新闻数据失败:', error);
                }
            },

            // 切换页面
            changePage(page) {
                if (page < 1 || page > this.totalPages) return;  // 确保页码合法
                this.currentPage = page;
                this.fetchNews();  // 切换页码时重新加载新闻数据
            },

            // 打开编辑新闻的模态框
            openEditModal(newsItem) {
                this.editingNews = { ...newsItem };  // 创建新闻副本进行编辑
                this.isModalOpen = true;
            },

            // 关闭编辑模态框
            closeEditModal() {
                this.isModalOpen = false;
            },

            // 更新新闻
            async updateNews() {
                try {
                    const response = await fetch(`http://127.0.0.1:8000/api/news/${this.editingNews.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(this.editingNews),
                    });
                    if (response.ok) {
                        this.closeEditModal();  // 关闭模态框
                        this.fetchNews();  // 刷新新闻列表
                    } else {
                        alert('更新失败');
                    }
                } catch (error) {
                    console.error('更新新闻失败:', error);
                }
            },

            // 删除新闻
            async deleteNews(newsId) {
                if (confirm('确定要删除这条新闻吗？')) {
                    try {
                        const response = await fetch(`http://127.0.0.1:8000/api/news/${newsId}`, {
                            method: 'DELETE',
                        });
                        if (response.ok) {
                            this.fetchNews();  // 删除后刷新新闻列表
                        } else {
                            alert('删除失败');
                        }
                    } catch (error) {
                        console.error('删除新闻失败:', error);
                    }
                }
            },
        },
    };
</script>

<style scoped>
    /* 模态框样式 */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        width: 400px;
    }

    .modal-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .modal-input, .modal-textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
    }

    .save-btn, .cancel-btn {
        padding: 8px 16px;
        cursor: pointer;
    }

    .save-btn {
        background-color: #4CAF50;
        color: white;
    }

    .cancel-btn {
        background-color: #f44336;
        color: white;
    }

    /* 分页按钮 */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination button {
        padding: 5px 10px;
        margin: 0 5px;
    }

    .pagination button.active {
        background-color: #4CAF50;
        color: white;
    }

    .pagination button:disabled {
        background-color: #e0e0e0;
    }

    /* 响应式设计 */
    @media (max-width: 768px) {
        .modal-content {
            width: 90%; /* 在小屏幕上让模态框占据更大的宽度 */
            padding: 15px; /* 调整内边距 */
        }

        .save-btn, .cancel-btn {
            padding: 10px 20px;
        }

        .pagination button {
            padding: 5px 8px; /* 减小分页按钮的尺寸 */
        }
    }

    @media (max-width: 480px) {
        .modal-content {
            width: 95%; /* 更小的屏幕时模态框宽度几乎占满屏幕 */
            padding: 10px; /* 减少内边距 */
        }

        .modal-actions {
            flex-direction: column; /* 将按钮垂直排列 */
            margin-top: 15px;
        }

        .save-btn, .cancel-btn {
            width: 100%; /* 按钮在小屏幕上占据整个宽度 */
            padding: 12px 0;
            margin-bottom: 10px; /* 增加按钮间的间距 */
        }

        .pagination {
            flex-direction: column; /* 在小屏幕上，分页按钮垂直排列 */
        }

        .pagination button {
            padding: 8px 12px;
            margin: 5px 0; /* 分页按钮的垂直间距 */
        }
    }
</style>

