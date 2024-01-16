from selenium import webdriver
from selenium.webdriver.common.by import By
import time

# Sets the Selenium webdriver to Chrome
driver = webdriver.Chrome()

# Function used to enter text into an input field
def enter_text(input_xpath, new_text):
    # Find Element by XPATH
    input = driver.find_element(By.XPATH, input_xpath)

    # Clears the input. Necessary if there is already text in the input
    input.clear()

    # Enter text into the element
    input.send_keys(new_text)


def main():
    # Load Webpage
    driver.get("http://localhost/SCDT61_CW2/")

    # Check the correct page has been loaded
    assert "Home" in driver.title

    # Clicks on the register navbar button
    driver.find_element(By.XPATH, "/html/body/nav/div/ul/li[7]/a").click()

    # Checks the register page has been loaded
    assert "Register Page" in driver.title

    # Enters text into the registration form
    reg_fname = "Test"
    reg_lname = "Member"
    reg_email = "testmember@test.com"
    reg_password = "P@ssword1"
    reg_rerpeat_password = "P@ssword1"
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", reg_fname) # First name field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", reg_lname) # last name field
    enter_text("/html/body/form/section/div/div/div/div/div/div[3]/input", reg_email) # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[4]/input", reg_password) # Password field
    enter_text("/html/body/form/section/div/div/div/div/div/div[5]/input", reg_rerpeat_password) # Confirm password field

    # Clicks the register button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()

    # Checks the login page has been loaded
    assert "Login Page" in driver.title

    # Waits 60 seconds before closing the chrome tab
    time.sleep(60)


if __name__ == "__main__":
    main()