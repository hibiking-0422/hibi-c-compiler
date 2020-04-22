<div id="app">
    <div class="cordingArea">
        <div class='logo'>
            <?php echo $this->Html->image('logo.png', ['alt' => 'logo']); ?>
        </div>
        <div class='logoMessage'>
            <span class='logoMessageFont'>Welcome to c++ complier!</span>
        </div>
        <div class='cordingPosition'>
            <textarea class="coding" spellcheck="false" @keydown.tab="tab" v-model="code"></textarea>
        </div>
        <div class='postButton'><button @click="postCompile">compile</button></div>
    
    
        <div class="terminal">
            <div class="terminal-title">OUT</div>
            <textarea class="terminal-area" v-model="results" readonly></textarea>
        </div>

        <div class='formArea'>
            <p><?= $this->Html->link("other codes", ['controller' => 'Codes', 'action' => 'index']) ?></p>
            <?php echo $this->Form->create($code); ?>
            <p>tite</p>
            <?php echo $this->Form->input('title'); ?>
            <p>name</p>
            <?php echo $this->Form->input('name'); ?>
            <p>description</p>
            <?php echo $this->Form->text('description', ["type" => "textarea",
                                        "cols" => 30,
                                        "rows" => 10,
                                        "label" => "テキストエリア"]); 
            ?>
            <div hidden>
            <?php
                echo $this->Form->input('code', [
                    'v-model' => 'code',
                ]);
            ?>
            <?php
                echo $this->Form->input('result', [
                    'v-model' => 'results',
                ]);
            ?>
            </div>
            <p>
            <?php
                echo $this->Form->button(__('Save Codes'));
                echo $this->Form->end();
            ?>
            </p>
        </div>
    </div>
    <div class='textArea'>
        <div class="chat-area" ref="chatScroll">
            <div v-for="chatMessage in messages" v-bind:key="chatMessage.id">{{ chatMessage }}</div>
        </div>
        <div class="chat-container">
            <input type="text" class="chat-input" v-model='message' v-on:keydown.enter='postChat' />
            <button class="chat-button" v-on:click='postChat'>post</button>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
<script>
let socket = io('192.168.11.17:4000');
var app = new Vue({
    el: "#app",
    data: {
            code: "#include <iostream>\nint main() { \n\tstd::cout << \"Hello, World!\" << std::endl; \n}",
            results: '>',
            elem: '',
            pos: '',
            val: '',
            socket: '',
            message: '',
            messages: [],
    },
    created() {
        this.socket = socket;
        this.socket.on('chat_from_server', (txt) => {
            console.log(txt);
            this.messages.push(txt);
        });
    },
    updated() {
        this.scrollToEnd()
    },
    methods: {
        postChat: function() {
            this.socket.emit('chat_from_front', this.message);
        },
        scrollToEnd() {
            this.$nextTick(() => {
                const chatLog = this.$refs.chatScroll
                if (!chatLog) return
                chatLog.scrollTop = chatLog.scrollHeight
            });
        },
        postCompile: function() {
        axios.get('http://160.16.95.101:9050/api/api.php', {params: {
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
});
</script>

<style>
.cordingArea {
    width: 70%;
    margin-right: auto;
    margin-left: auto;
    margin-top: 25px;
}

.coding {
    width: 70%;
    height: 400px;
    font-size: 1.3em;
    outline: none;
}

.cordingPosition {
    width: 100%;
    text-align: center;
}

.terminal {
    width: 70%;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: 50px;
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

.formArea {
    width: 50%;
    margin-right: auto;
    margin-left: auto;
    border: solid 1px;
    text-align: center;
    margin-bottom: 50px;
}

.chat-area {
  width: 100%;
  height: 44.5vh;
  border: solid green;
  border-radius: 10px;
  position: relative;
  overflow:scroll;
  overflow-x: hidden;
  margin-right: auto;
  margin-left: auto;
}

.chat-container {
  width: 100%;
}

.chat-input {
  width: 70%;
}
.chat-button {
  width: 26%;
}
.textArea {
    width: 15%;
    position:fixed;
    right:  10px;                /* 右からの位置指定 */
    top: 10px;  
}

</style>
