const validated = (data) => {
    let result = false;
    data.each(function (_, item) {
        result = false;
        const type = item.type;
        const title = item.title;
        const name = item.name;
        const value = item.value;
        const id = item?.id;
        if (value.trim() === "") {
            alert(formEmptyValueMessage(type, title));
            item.focus();
            return false;
        }
        let regexResult = regexValidated(name, value, title, id);
        if (regexResult === false) {
            return false;
        }
        result =  true;
    });
    return result;
}

const regexValidated = (name, value, title, id = null) => {
    const message = "이(가) 잘못된 형식입니다.";
    let result = true;
    switch (name) {
        case 'phone':
            if (phoneNumberReg.test(value) === false) {
                alert(`${title}${message} \n(-없이 입력해주세요)`);
                result = false;
                return false;
            }
            break;
        case 'tel':
            if (normalTelDashReg.test(value) === false) {
                alert(`${title}${message}`);
                result = false;
                return false;
            }
            break;
        case 'fax':
            if (normalTelDashReg.test(value) === false) {
                alert(`${title}${message}`);
                result = false;
                return false;
            }
            break;
        case 'business_number':
            if (bussinessNumberReg.test(value) === false) {
                alert(`${title}${message}`);
                result = false;
                return false;
            }
            break;
        case 'email':
            if (emailReg.test(value) === false) {
                alert(`${title}${message}`);
                result = false;
                return false;
            }
            break;
        case 'password':
            if (id !== "old_password") {
                if (passwordReg.test(value) === false) {
                    alert(`${title}는 영어,숫자,특수문자가 하나씩 포함 8자 이상 16자 이하가 되어야 합니다.`);
                    result = false;
                    return false;
                }
            }
            break;
        case 'password_confirm':
            if (passwordReg.test(value) === false) {
                alert(`${title}는 영어,숫자,특수문자가 하나씩 포함 8자 이상 16자 이하가 되어야 합니다.`);
                result = false;
                return false;
            }
            break;
        case 'identity':
            if (englishNumberReg.test(value) === false) {
                alert(`${title}${message}`);
                result = false;
                return false;
            }
            break;
    }
}

const formEmptyValueMessage = (type, title) => {
    switch (type) {
        case 'select':
            return `${title}를(을) 선택해주세요.`;
        case 'textarea':
            return `${title}를(을) 입력해주세요.`;
        case 'checkbox':
            return `${title}를(을) 선택해주세요.`;
        case 'radio':
            return `${title}를(을) 선택해주세요.`;
        case 'file':
            return `${title}를(을) 등록해주세요.`;
        default:
            return `${title}를(을) 입력해주세요.`;
    }
}

const confirmPassword = (name) => {

}

// const checkFile = (file) => {
//     const MAXSIZE = 5 * 1024 * 1024;
//     if (file !== undefined) {
//         if (file.size > MAXSIZE) {
//             alert("파일 크기가 5MB가 초과하였11습니다.");
//             return false;
//         }
//         return file;
//     }
//     return false;
// }