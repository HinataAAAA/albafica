<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="3">
                <img :src="info.avatar" width="100%" style="border-radius: 50%"/>
            </el-col>
            <el-col :span="21">
                <h1>{{info.name}}</h1>
                <small>{{info.info}}</small>
            </el-col>
            <el-col :span="24" style="margin-top: 30px ">
                <el-carousel trigger="click" height="150px">
                    <el-carousel-item>
                        <h3>{{ info.solved }} Accepted</h3>
                    </el-carousel-item>
                    <el-carousel-item>
                        <h3>{{info.solved}} Submited</h3>
                    </el-carousel-item>
                    <el-carousel-item>
                        <h3>{{ info.solved }} Posted</h3>
                    </el-carousel-item>
                </el-carousel>
            </el-col>
            <el-col :span="12">
                <div class="info-content">
                <div class="article">
                    <h3>文章 <div style="float:right" class="more" href="" @click="postDialog=true">更多</div></h3>
                </div>
                    <el-table :data="info.posts.slice(0, 5)" style="width: 100%">
                        <el-table-column prop="title" label="名称">
                        </el-table-column>
                        <el-table-column prop="created_at" label="创建时间"
                                width="180">
                        </el-table-column>
                        <el-table-column prop="updated_at" label="更新时间"
                                width="180">
                        </el-table-column>
                    </el-table>
                </div>
                <div class="info-content">

                <div class="status">
                    <h3>提交状态 <div style="float:right" class="more" href="" @click="solutionDialog=true">更多</div></h3>
                </div>
                    <el-table :data="info.solution.slice(0, 5)" style="width: 100%">
                        <el-table-column prop="user_id" label="用户">
                        </el-table-column>
                        <el-table-column prop="lang" label="语言"
                                width="180">
                        </el-table-column>
                        <el-table-column prop="result" label="结果"
                                width="180">
                        </el-table-column>
                    </el-table>
                </div>
            </el-col>
            <el-col :span="12">
                <div class="info-content">
                    <div class="article">
                        <h3>关注者 <div style="float:right" class="more" @click="followerDialog=true">更多</div></h3>
                    </div>
                    <el-table :data="info.followers.slice(0, 5)" style="width: 100%">
                        <el-table-column prop="name" label="名称"
                                width="80">
                        </el-table-column>
                        <el-table-column prop="email" label="邮箱"
                                width="180">
                        </el-table-column>
                        <el-table-column prop="info" label="简介">
                        </el-table-column>
                    </el-table>
                </div>
                <div class="info-content">
                    <div class="status">
                        <h3>团队 <div style="float:right" class="more" @click="teamDialog=true">更多</div></h3>
                    </div>
                    <el-table :data="info.teams.slice(0, 5)" style="width: 100%">
                        <el-table-column prop="name" label="名称"
                                width="120">
                        </el-table-column>
                        <el-table-column prop="desc" label="描述">
                        </el-table-column>
                    </el-table>
                </div>
            </el-col>
        </el-row>
        <el-dialog title="文章列表" v-model="postDialog">
            <el-table :data="info.posts" style="width: 100%">
                <el-table-column prop="title" label="名称">
                </el-table-column>
                <el-table-column prop="created_at" label="创建时间"
                                 width="180">
                </el-table-column>
                <el-table-column prop="updated_at" label="更新时间"
                                 width="180">
                </el-table-column>
            </el-table>
        </el-dialog>
        <el-dialog title="关注者列表" v-model="followerDialog">
            <el-table :data="info.followers" style="width: 100%">
                <el-table-column prop="name" label="名称"
                                 width="80">
                </el-table-column>
                <el-table-column prop="email" label="邮箱"
                                 width="180">
                </el-table-column>
                <el-table-column prop="info" label="简介">
                </el-table-column>
            </el-table>
        </el-dialog>
        <el-dialog title="评测列表" v-model="solutionDialog">
            <el-table :data="info.solution" style="width: 100%">
                <el-table-column prop="user_id" label="用户">
                </el-table-column>
                <el-table-column prop="lang" label="语言"
                                 width="180">
                </el-table-column>
                <el-table-column prop="result" label="结果"
                                 width="180">
                </el-table-column>
            </el-table>
        </el-dialog>
        <el-dialog title="团队列表" v-model="teamDialog">
            <el-table :data="info.teams" style="width: 100%">
                <el-table-column prop="name" label="名称"
                                 width="120">
                </el-table-column>
                <el-table-column prop="desc" label="描述">
                </el-table-column>
            </el-table>
        </el-dialog>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                info: {
                    posts: [],
                    followers: [],
                    solution: [],
                    teams: []
                },
                postDialog: false,
                followerDialog: false,
                solutionDialog: false,
                teamDialog: false
            };
        },
        mounted: function () {
            var _this = this;
            axios.get('user/info')
                .then(function (res) {
                    _this.info = res.data;
                });
        }
    }
</script>

<style>
    .info{
        text-align: center;
        line-height: 20px;
        vertical-align: middle;
    }

    .more{
        color:#00a2ca;
        bottom: 0px;
        font-size: 12px;
        float: right;
    }

    .el-carousel__item{
        text-align: center;
    }

    .el-carousel__item h3 {
        color: #475669;
        font-size: 14px;
        opacity: 0.75;
        line-height: 150px;
        margin: 0;
    }

    .el-carousel__item:nth-child(2n) {
        background-color: #99a9bf;
    }

    .el-carousel__item:nth-child(2n+1) {
        background-color: #d3dce6;
    }

    .info-content{
        min-height: 300px;
    }
</style>