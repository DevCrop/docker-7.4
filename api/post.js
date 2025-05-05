console.log('post');

const frm = document.getElementById('frm');

frm.addEventListener('submit', async function (e) {
  e.preventDefault();

  const fd = new FormData(frm);
    
  try {
    const res = await fetch(frm.action, {
      method: 'POST',
      body: fd
    });

    const data = await res.json();

    if (data.result.success) {
      alert('파일이 성공적으로 업로드되었습니다.');
      location.reload();
    } else {
      alert(`오류: ${data.error || '업로드 실패'}`);
    }

  } catch (error) {
    console.error(error);
    alert('네트워크 오류 또는 서버 응답 실패');
  }
});
