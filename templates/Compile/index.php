<div id="app">
    <div>
        <div class="cordingArea">
            <div class='logo'>
                <?php echo $this->Html->image('logo.png', ['alt' => 'logo']); ?>
            </div>
            <div class='logoMessage'>
                <span class='logoMessageFont'>Welcome to c++ complier!</span>
            </div>
            <textarea class="coding" spellcheck="false" @keydown.tab="tab" v-model="code"></textarea>
            <div class='postButton'><button @click="postCompile">compile</button></div>
        </div>
        
        <div class="terminal">
            <div class="terminal-title">OUT</div>
            <textarea class="terminal-area" v-model="results" readonly></textarea>
        </div>
    </div>
</div>
<p><?= $this->Html->link("みんなの投稿", ['controller' => 'Codes', 'action' => 'index']) ?></p>
<p><?= $this->Html->link("みんなの投稿", ['controller' => 'Codes', 'action' => 'add']) ?></p>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
var app = new Vue({
    el: "#app",
    data: {
            code: "#include <iostream>\nint main() { \n\tstd::cout << \"Hello, World!\" << std::endl; \n}",
            results: '>',
            elem: '',
            pos: '',
            val: ''
    },
    methods: {
        postCompile: function() {
        axios.get('http://192.168.11.17:9050/api/api.php', {params: {
            code: this.code
        }}).then(response =>{
            this.results += ' ' + response.data + '>';
            console.log(response.data);
        });
        },
        tab: function(event) {
            event.preventDefault();
            this.elem = event.target;
            this.pos = this.elem.selectionStart;
            this.val = this.elem.value;
            this.elem.value = this.val.substr(0, this.pos) + '\t' + this.val.substr(this.pos, this.val.length);
            this.elem.setSelectionRange(this.pos + 1, this.pos + 1);
        }
    }
})
</script>

<style>
.cordingArea {
    width: 70%;
    margin-right: auto;
    margin-left: auto;
    margin-top: 25px;
}

.coding {
    width: 100%;
    height: 400px;
    font-size: 1.3em;
    outline: none;
}

.terminal {
    width: 70%;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: 300px;
    margin-top: 50px;
}

.terminal-title {
    text-align: left;
    background-color: black;
    width: 50px;
    color: white;
    letter-spacing: 0.3em;
    padding-left: 10px;
    padding-right: 5px;
    border: double 4px #333;
}

.terminal-area {
    font-family: 'courier new', Futura, Helvetica, '游ゴシック', 'メイリオ', Osaka;
    width: 100%;
    height: 200px;
    overflow: auto;    /* IEでは設定しておかないとスクロールバーが表示されしまう */
    display: block;    /* 指定しないとスクロールバーが表示される */
    border: none;    /* 変な余白が出ないように */
    background-color: black;
    color: white;
    font-size: 12pt;
    line-height: 1.4em;    /* 全角文字を入力時にこれ以上の高さがないと入力時にぎくしゃくするため */
    border: double 4px #333;
}

.postButton {
    width: 100px;
    margin-right: auto;
    margin-left: auto;
}

.logoArea {
    width: 500px;
    margin-right: auto;
    margin-left: auto;
}

.logo{
    text-align: center;
}

.logoMessage {
    text-align: center;
    margin-top: 25px;
    margin-bottom: 25px;
}

.logoMessageFont {
    font-size: 25px;
}
</style>