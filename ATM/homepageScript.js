function confirmAccountDeletion() {
  if (confirm("Are you sure you want to delete your bank account?")) {
    window.location.href = "DeleteAccount.html";
  }
}
