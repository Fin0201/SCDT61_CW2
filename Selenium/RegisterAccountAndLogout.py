from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time

# Sets the Selenium webdriver to Chrome
driver = webdriver.Chrome()

# Function used to click on HTML elements
def click_element(input_xpath):
    # Find Element by XPATH
    element = driver.find_element(By.XPATH, input_xpath)

    # Click Element
    element.click()

# Function used to enter text into an input field
def enter_text(input_xpath, new_text):
    # Find Element by XPATH
    input = driver.find_element(By.XPATH, input_xpath)

    # Enter text into the element
    input.send_keys(new_text)


def main():
    # Load Webpage
    driver.get("http://localhost/SCDT61_CW2/")

    # Check the correct page has been loaded
    assert "Home" in driver.title

    # Clicks on the register navbar button
    click_element("/html/body/nav/div/ul/li[7]/a")

    # Checks the correct page has been loaded
    assert "Register Page" in driver.title

    # Enters text into the registration form
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", "Test") # First name field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", "Member") # last name field
    enter_text("/html/body/form/section/div/div/div/div/div/div[3]/input", "testmember@test.com") # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[4]/input", "P@ssword1") # Password field
    enter_text("/html/body/form/section/div/div/div/div/div/div[5]/input", "P@ssword1") # Confirm password field

    # Clicks the register button
    click_element("/html/body/form/section/div/div/div/div/div/button")

    # Checks the correct page has been loaded
    assert "Member Page" in driver.title

    # Clicks the logout button
    click_element("/html/body/a")

    # Checks the correct page has been loaded
    assert "Lo Page" in driver.title



    


if __name__ == "__main__":
    main()
    # Waits 60 seconds before closing the chrome tab
    time.sleep(60)