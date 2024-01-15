from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time

# Sets the Selenium webdriver to Chrome
driver = webdriver.Chrome()

# Function used to enter text into an input field
def enter_text(input_xpath, new_text):
    input = driver.find_element(By.XPATH, input_xpath)
    input.send_keys(new_text)

#Load Webpage
driver.get("http://localhost/SCDT61_CW2/")

#Check the webpage has been loaded
assert "Home" in driver.title

#Find Element by XPATH
Login_SignUp_Button = driver.find_element(By.XPATH, "/html/body/header/div/div/div/div[2]/div/ul/li[4]/a")

#Click Element
Login_SignUp_Button.click()

assert "New User Signup" in driver.page_source
name_input = driver.find_element(By.XPATH, "/html/body/section/div/div/div[3]/div/form/input[2]")
email_input = driver.find_element(By.XPATH, "/html/body/section/div/div/div[3]/div/form/input[3]")

name_input.send_keys("Test")
email_input.send_keys("email@email.com.emdahhgfhijhjhgl.co.uk")

signup_input = driver.find_element(By.XPATH, "/html/body/section/div/div/div[3]/div/form/button")
signup_input.click()