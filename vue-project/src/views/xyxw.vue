<template>
    <div class="no-global-styles">
    <div class="haed">
        <div class="conse">
            <div class="nwe">
                <div class="lest">
                    <h1>学院</h1>
                </div>
                <div class="rest">
                    <div class="rest-con"></div>
                    <div class="rest-txt"></div>
                </div>
            </div>
            <div class="lest-txt">
                <ul>
                    <li>
                        <div class="lest-txt1">
                        <div class="img"><img :src="imageSrc" alt="Image"></div>
                        <h4 class="txt">武汉大学成功举办2025年“数智英才信息学科拔尖计划”冬令营</h4>
                        <div class="text">2025年1月19日至20日，武汉大学成功举办2025年“数智英才信息学科拔尖计划”冬令营</div>
                        <span>2025-01-22</span>
                    </div>
                    </li>
<!--                    <li>-->
<!--                        <div class="lest-txt2">-->
<!--                            <div class="lest-txt2-con">-->
<!--                                <div class="img">-->
<!--                                    <img :src="text1" alt="Image">-->
<!--                                </div>-->
<!--                                <div class="txt2-txt">-->
<!--                                    <div class="txt2-1">国家重点研发计划项目“基于孕期筛查大数据和人工智能”</div>-->
<!--                                    <div class="txt2-2">新闻网讯（通讯员：韩梦雅）1月18日，武汉大学牵头的“十四五”国家重点研发计划项目...</div>-->

<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="lest-txt2-con">-->
<!--                                <div class="img"><img :src="text2" alt="Image"></div>-->
<!--                                <div class="txt2-txt">-->
<!--                                    <div class="txt2-1">提升党建质量，筑牢发展根基 ——计算机学院召开2024年...</div>-->
<!--                                    <div class="txt2-2">为深入贯彻党的二十大、二十届三中全会精神，全面推进基层党组织...</div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="lest-txt2-con">-->
<!--                                <div class="img"><img :src="text3" alt="Image"></div>-->
<!--                                <div class="txt2-txt">-->
<!--                                    <div class="txt2-1">计算机学院举行党外人士座谈会</div>-->
<!--                                    <div class="txt2-2">2025年1月10日，为及时向民主党派和无党派人士通报学校和学...</div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="lest-txt3">-->
<!--                        <div class="lest-txt2-con">-->
<!--                            <div class="img"><img :src="text3_1" alt="Image"></div>-->
<!--                            <div class="txt2-txt">-->
<!--                                <div class="txt2-1">院领导慰问党员代表 送上新春问候和祝福</div>-->
<!--                                <div class="txt2-2">近日，为落实上级有关通知精神，增强基层党组织的凝聚力，了解...</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="lest-txt2-con">-->
<!--                            <div class="img"><img :src="text1" alt="Image"></div>-->
<!--                            <div class="txt2-txt">-->
<!--                                <div class="txt2-1">计算机学院举行2024年教职工荣休仪式 暨退休教职工座谈会</div>-->
<!--                                <div class="txt2-2">1月10日，计算机学院举行教职工荣休仪式暨退休教职工座谈会。...</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="lest-txt2-con">-->
<!--                            <div class="img"><img :src="text3_3" alt="Image"></div>-->
<!--                            <div class="txt2-txt">-->
<!--                                <div class="txt2-1">学院召开2024年度党政管理部门述职考核评议会暨办公室...</div>-->
<!--                                <div class="txt2-2">2025年1月7日下午14:00，计算机学院在院B404会议室召开了...</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    </li>-->
<!--                    <li v-for="(news, index) in newsList.slice(0, 2)" :key="index">-->
<!--                        <div class="lest-txt3">-->
<!--                            &lt;!&ndash; Render 3 different lest-txt2-con divs within each li &ndash;&gt;-->
<!--                            <div v-for="(subNews, subIndex) in [news, news, news]" :key="subIndex" class="lest-txt2-con">-->
<!--                                <div class="img">-->
<!--                                    <img :src="subNews.imageSrc" alt="Image">-->
<!--                                </div>-->
<!--                                <div class="txt2-txt">-->
<!--                                    <div class="txt2-1">{{ subNews.title }}</div>-->
<!--                                    <div class="txt2-2">{{ subNews.content }}</div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </li>-->
                    <li v-for="(chunk, chunkIndex) in chunkNews(newsList)" :key="chunkIndex">
                        <div class="lest-txt3">
                            <!-- 每三个新闻条目展示在一个 li 中 -->
                            <div v-for="(subNews, subIndex) in chunk" :key="subIndex" class="lest-txt2-con">
                                <div class="img">
                                    <img :src="subNews.image" alt="Image">
                                </div>
                                <div class="txt2-txt">
                                    <div class="txt2-1">{{ subNews.title }}</div>
                                    <div class="txt2-2">{{ subNews.content }}</div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</template>
<style>
    @import "../assets/css/header.css";
    @import "../assets/css/head-flex.css";

</style>

<script>
    import imageSrc from '@/assets/im/1.png';
    import text1 from '@/assets/im/text-1.png';
    import text2 from '@/assets/im/text-2.png';
    import text3 from '@/assets/im/text-3.png';
    import text3_1 from '@/assets/im/text3-1.png';
    import text3_3 from '@/assets/im/text3-3.png';

    export default {
        data() {
            return {
                // 新闻列表相关
                newsList: [],  // 存储新闻列表
                currentPage: 1,  // 当前页
                totalPages: 0,  // 总页数
                totalNewsCount: 0,  // 总新闻数量
                pageSize: 5,  // 每页显示的新闻数

                // 编辑模态框相关
                isModalOpen: false,  // 控制编辑模态框的显示
                editingNews: null,  // 正在编辑的新闻

                // 加载状态
                isLoading: false,  // 加载状态
                errorMessage: '',  // 错误消息

                // 图片和文本绑定（确保你在组件中定义了这些变量）
                imageSrc, // 图片绑定
                text1,    // 文本 1
                text2,    // 文本 2
                text3,    // 文本 3
                text3_1,  // 文本 3_1
                text3_3,  // 文本 3_3
            };
        },

        created() {
            this.fetchNews();  // 初始化时获取新闻数据
        },

        methods: {
            // 获取新闻数据，支持分页
            async fetchNews() {
                this.isLoading = true;
                this.errorMessage = '';

                try {
                    const response = await fetch(`http://127.0.0.1:8000/api/news?page=${this.currentPage}&per_page=${this.pageSize}`);
                    const contentType = response.headers.get('Content-Type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('返回的数据不是 JSON 格式');
                    }

                    const data = await response.json();
                    if (Array.isArray(data.newsList)) {
                        this.newsList = data.newsList.map(news => {
                            if (news.image) {
                                news.imageSrc = news.image;  // 为了方便绑定到图片元素
                            }
                            return news;
                        });
                        this.totalNewsCount = data.total;
                        this.totalPages = data.lastPage;
                    } else {
                        throw new Error('newsList 不是一个数组');
                    }
                } catch (error) {
                    this.errorMessage = '加载新闻失败，请稍后再试。';
                } finally {
                    this.isLoading = false;
                }
            },

            // 切换页面
            changePage(page) {
                if (page < 1 || page > this.totalPages) return;
                this.currentPage = page;
                this.fetchNews();
            },

            // 打开编辑新闻的模态框
            openEditModal(newsItem) {
                this.editingNews = { ...newsItem };
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
                        this.closeEditModal();
                        this.fetchNews();
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
                            this.fetchNews();
                        } else {
                            alert('删除失败');
                        }
                    } catch (error) {
                        console.error('删除新闻失败:', error);
                    }
                }
            },

            // 将新闻列表按每 3 条划分为一个数组
            chunkNews(newsList) {
                const chunkSize = 3;
                const chunks = [];
                for (let i = 0; i < newsList.length; i += chunkSize) {
                    chunks.push(newsList.slice(i, i + chunkSize));
                }
                return chunks;
            },
        },
    };
</script>



<style scoped>
    .publish-news-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .publish-news-btn:hover {
        background-color: #45a049;
    }
</style>
