export default function ({ $axios, error: nuxtError }) {
  console.log(error)

  $axios.onError(error => {
  //   nuxtError({
  //     statusCode: error.response.status,
  //     message: error.message,
  //   });
  //   return Promise.resolve(false);
      if (error.error === 'Unauthenticated.' || error.message === 'Unauthenticated.') {
          this.$router.push('login');
      }
      return false
  })
}
