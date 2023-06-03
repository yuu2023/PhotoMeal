'use strict';

class Image {
    // ファイルが画像(jpeg, png, gif)か判定。
    isImage(arrayBuffer) {
        const arr = new Uint8Array(arrayBuffer).subarray(0, 4);
        let header = '';

        for(let i = 0; i < arr.length; i++) {
            header += arr[i].toString(16);
        }

        if(/^ffd8ff/.test(header)) {
            // jpeg
            return true;
        }

        if(/^89504e47/.test(header)) {
            // png
            return true;
        }

        if(/^47494638/.test(header)) {
            // gif
            return true;
        }

        return false;
    }

    // ブラウザ内のローカル環境でのみ有効なURLを作成。
    createLocalURL(file) {
        return window.URL.createObjectURL(file);
    }

    // imgData(img.src)をファイルへ変換する
    convertToFile (imgData/*, file*/) {
        const blob = atob(imgData.replace(/^.*,/, ''));
        let buffer = new Uint8Array(blob.length);
        for (let i = 0; i < blob.length; i++) {
            buffer[i] = blob.charCodeAt(i);
        }
        return new File([buffer.buffer]/*, file.name, {type: file.type}*/);
    }

} export default Image;
