<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Signup Popup Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            margin-bottom: 3em;
        }
        .navbar-brand {
            margin-left: 1.5rem;
        }
        .nav-item {
            margin-right: 15px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: bold;
        }
        .navbar-nav {
            flex-grow: 1;
        }
        .nav-item.login {
            margin-left: auto;
            margin-right: 20px; /* 로그인과 회원가입 버튼 사이 간격 */
            font-weight: bold;
        }
        .nav-item.signup {
            margin-right: 100px; /* 오른쪽 끝에서의 간격 */
            font-weight: bold;
        }

        /* 모달 팝업 위치 조정 */
        .modal-dialog {
            margin-top: 200px; /* 여기서 모달이 화면의 중앙에서 아래로 얼마나 내려갈지 조정 */
        }
        .modal-content {
            z-index: 100000;
        }
    </style>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><div class="logo-text">PocketTrip</div></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="#">경비계산</a>
            <a class="nav-item nav-link" href="#">내일정</a>
            <a class="nav-item nav-link login" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            <a class="nav-item nav-link signup" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">회원가입</a>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">로그인</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailInput" placeholder="이메일을 입력해주세요">
                    </div>
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">비밀번호</label>
                        <input type="password" class="form-control" id="passwordInput" placeholder="비밀번호를 입력해주세요">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">로그인</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="openSignupModal">회원가입</button>
            </div>
        </div>
    </div>
</div>

<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">회원가입</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="signupEmailInput" class="form-label">Email</label>
                        <input type="text" class="form-control" id="signupEmailInput" placeholder="사용하실 이메일을 입력해주세요">
                    </div>
                    <div class="mb-3">
                        <label for="signupPasswordInput" class="form-label">비밀번호</label>
                        <input type="password" class="form-control" id="signupPasswordInput" placeholder="사용하실 비밀번호를 입력해주세요">
                    </div>
                    <div class="mb-3">
                        <label for="signupConfirmPasswordInput" class="form-label">비밀번호 확인</label>
                        <input type="password" class="form-control" id="signupConfirmPasswordInput" placeholder="비밀번호를 한번 더 입력해주세요">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">회원가입</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // 회원가입 버튼을 클릭하면 로그인 모달을 닫고 회원가입 모달을 표시
    document.getElementById('openSignupModal').addEventListener('click', function () {
        var loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
        loginModal.hide();

        setTimeout(function() {
            var signupModal = new bootstrap.Modal(document.getElementById('signupModal'));
            signupModal.show();
        }, 500); // 딜레이 추가
    });

    // 모든 모달이 닫힐 때 발생하는 이벤트를 감지하여 백드롭을 적절하게 처리
    document.getElementById('signupModal').addEventListener('hidden.bs.modal', function () {
        document.body.classList.remove('modal-open');
        var backdrops = document.querySelectorAll('.modal-backdrop');
        if (backdrops) {
            backdrops.forEach(function(backdrop) {
                backdrop.remove();
            });
        }
    });

    // 로그인 모달이 열릴 때 백드롭 문제를 방지
    document.getElementById('loginModal').addEventListener('show.bs.modal', function () {
        setTimeout(function() {
            var backdrops = document.querySelectorAll('.modal-backdrop');
            if (backdrops.length > 1) {
                backdrops[0].remove();
            }
        }, 500);
    });

    // 회원가입 폼 검사 및 AJAX 요청
    document.querySelector('#signupModal form').addEventListener('submit', function(event) {
        event.preventDefault(); // 폼의 기본 제출 동작을 막음

        // 입력 필드 가져오기
        var useremail = document.getElementById('signupEmailInput').value.trim(); // 이메일로 사용될 필드
        var password = document.getElementById('signupPasswordInput').value.trim();
        var confirmPassword = document.getElementById('signupConfirmPasswordInput').value.trim();

        // 검사 조건
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // 이메일 형식 검사
        var passwordPattern = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/; // 영문, 숫자, 특수문자 조합
        var minPasswordLength = 6; // 최소 비밀번호 길이

        // 유효성 검사
        if (!emailPattern.test(useremail)) {
            alert('유효한 이메일 주소를 입력해주세요.');
            return;
        }

        if (!passwordPattern.test(password)) {
            alert('비밀번호는 최소 6자 이상이어야 하며, 영문, 숫자, 특수문자를 포함해야 합니다.');
            return;
        }

        if (password !== confirmPassword) {
            alert('비밀번호가 일치하지 않습니다.');
            return;
        }

        // 사용자 확인 창
        var confirmMessage = `이메일: ${useremail}\n비밀번호: ${'*'.repeat(password.length)}\n\n위의 정보로 회원가입을 진행하시겠습니까?`;
        var userConfirmed = confirm(confirmMessage);

        if (!userConfirmed) {
            return; // 사용자가 확인하지 않으면 AJAX 요청을 중단
        }

        // AJAX 요청
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/plan/sign_on', true);
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert('회원가입이 완료되었습니다!');
                    var signupModal = bootstrap.Modal.getInstance(document.getElementById('signupModal'));
                    signupModal.hide(); // 회원가입 모달 닫기
                } else {
                    alert('회원가입에 실패했습니다. 다시 시도해주세요.');
                }
            }
        };
        xhr.send(JSON.stringify({
            useremail: useremail,
            password: password
        }));
    });
</script>
