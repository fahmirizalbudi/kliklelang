const userProfile = document.querySelector('.user-profile')

userProfile.addEventListener('click', (event) => {
  event.stopPropagation()
  userProfile.classList.toggle('active')
})

document.addEventListener('click', () => {
  userProfile.classList.remove('active')
})