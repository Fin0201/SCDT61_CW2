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

    # Clears the input. Necessary if there is already text in the input
    input.clear()

    # Enter text into the element
    input.send_keys(new_text)


def main():
    # Load Webpage
    driver.get("http://localhost/SCDT61_CW2/")

    # Check the correct page has been loaded
    assert "Home" in driver.title

    # Clicks on the login navbar button
    click_element("/html/body/nav/div/ul/li[8]/a")

    # Checks the register page has been loaded
    assert "Login Page" in driver.title

    # Enters text into the login form
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", "admin@test.com") # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", "P@ssword1") # Password field

    # Clicks the login button
    click_element("/html/body/form/section/div/div/div/div/div/button")
    
    # Checks the user has been logged in
    assert "Inventory Page" in driver.title

    # Loads the roles page
    click_element("/html/body/nav/div/ul/li[4]/a")

    # Checks the roles page has been loaded
    assert "Roles Page" in driver.title

    # Clicks on the delete button for the third item in the table
    click_element("/html/body/div[1]/table/tbody[2]/tr[3]/td[4]/form[2]/button")

    # Checks the roles page has been reloaded
    assert "Roles Page" in driver.title

    # Waits 60 seconds before closing the chrome tab
    time.sleep(60)


if __name__ == "__main__":
    main()