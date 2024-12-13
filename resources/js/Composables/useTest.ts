import { ref } from "vue";
export default function () {
    const count = ref(0);
    const color = ref("blue")
    const myMessage = ref("This is Another Message")
    function onClickHandle () {
        count.value++
    }

    return {
        count,
        color,
        myMessage,
        onClickHandle
    }
}
